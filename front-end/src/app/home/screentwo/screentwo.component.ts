import { Component, OnInit } from '@angular/core';
import { Router, RouterOutlet } from '@angular/router';
import { TravelDataService } from '../../interfaces/travelData.interface';
import Swal from 'sweetalert2';
import { FormsModule } from '@angular/forms';
import { CurrencyService } from '../../services/currency.service';
import { TranslateModule, TranslateService } from '@ngx-translate/core';

@Component({
  selector: 'screentwo-root',
  standalone: true,
  imports: [RouterOutlet, FormsModule, TranslateModule],
  templateUrl: './screentwo.component.html',
  styles: '' // Estilos vacíos; puedes agregar estilos aquí si es necesario
})
export class ScreenTwoComponent implements OnInit {
  amountCop: number | null = null; // Presupuesto en pesos colombianos
  countryId: number | null = this.travelDataService.getCountry(); // Obtén el país desde el servicio
  cityId: number | null = this.travelDataService.getCity(); // Obtén la ciudad desde el servicio
  userId: number = 6; // Asegúrate de obtener este valor según tu lógica

  // Constructor para inyectar las dependencias
  constructor(
    private travelDataService: TravelDataService,
    private currencyService: CurrencyService,
    private router: Router,
    private translate: TranslateService
  ) {}

  // Método que se ejecuta al inicializar el componente
  ngOnInit(): void {
    this.translate.use(this.translate.currentLang); // Establecer el idioma actual para la traducción
  }

  // Método para manejar el envío del formulario
  onSubmit(): void {
    if (this.amountCop == null || this.amountCop <= 0) {
      // Verifica si el presupuesto es válido
      Swal.fire({
        icon: 'warning',
        title: 'Faltan datos',
        text: 'Debes ingresar el presupuesto',
        confirmButtonText: 'OK'
      });
    } else {
      const validCountryId = this.countryId as number;
      const validCityId = this.cityId as number;

      // Guarda los datos del viaje y navega a la siguiente pantalla
      this.currencyService.saveTravelData(this.amountCop, validCountryId, validCityId, this.userId)
        .subscribe(response => {
          console.log('Datos guardados con éxito:', response);
          this.travelDataService.setDates(response); // Guarda los datos en el servicio
          this.router.navigate(['screenthree']); // Navega a la pantalla tres
        }, error => {
          console.error('Error al guardar los datos:', error);
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Ocurrió un error al guardar los datos',
            confirmButtonText: 'OK'
          });
        });
    }
  }

  // Método para redirigir al usuario a la pantalla de inicio
  goBack(): void {
    this.router.navigate(['']); // Navegar a la ruta principal
  }
}
  