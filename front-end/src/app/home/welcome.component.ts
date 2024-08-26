import { Component, OnInit } from '@angular/core';
import { RouterOutlet, RouterModule, RouterLink, Router } from '@angular/router';
// import { ReactiveFormsModule } from '@angular/forms';
import { UbicationService } from '../services/ubication.service';
import { CitiesInterface } from '../interfaces/cities.interface';
import { CountriesInterface } from '../interfaces/countries.interface';
import { TravelDataService } from '../interfaces/travelData.interface';
import Swal from "sweetalert2";
import { CommonModule } from '@angular/common';
import { TranslateModule, TranslateService } from '@ngx-translate/core';

@Component({
  selector: 'welcome-root',
  standalone: true,
  imports: [RouterOutlet, RouterLink, RouterModule, CommonModule, TranslateModule],
  templateUrl: './welcome.component.html',
  styleUrls: ['./welcome.component.css'] // Corregido 'styleUrl' a 'styleUrls'
})
export class WelcomeComponent implements OnInit {
  userName: string = ''; // Nombre de usuario
  cityList: CitiesInterface[] = []; // Lista de ciudades
  countryList: CountriesInterface[] = []; // Lista de países
  selectedCountry: number | null = null; // País seleccionado
  selectedCity: number | null = null; // Ciudad seleccionada

  // Constructor para inyectar dependencias
  constructor(
    private ubicationService: UbicationService,
    private travelDataService: TravelDataService,
    private router: Router,
    private translate: TranslateService
  ) {
    // Configurar el idioma por defecto
    translate.setDefaultLang('es');
    translate.use('es'); // Usar español por defecto
  }

  ngOnInit(): void {
    // Obtener todos los países al iniciar el componente
    this.getAllCountries();

    // Configurar el idioma guardado en localStorage
    const savedLang = localStorage.getItem('selectedLanguage');
    if (savedLang) {
      this.translate.use(savedLang);
    } else {
      this.translate.use('es'); // Idioma por defecto si no hay guardado
    }
  }

  // Método para obtener todos los países
  getAllCountries(): void {
    this.ubicationService.getCountries().subscribe((response: any) => {
      this.countryList = response.countries;
    });
  }

  // Método llamado cuando cambia la selección de país
  onCountryChange(event: any): void {
    const countryId = +event.target.value; // Obtener el ID del país
    this.selectedCountry = countryId;
    this.getCities(countryId); // Obtener las ciudades para el país seleccionado
    this.travelDataService.setCountry(countryId); // Guardar el país seleccionado
  }

  // Método para obtener ciudades de un país
  getCities(countryId: number): void {
    this.ubicationService.getCities(countryId).subscribe((data: any) => {
      this.cityList = data.cities;
    });
  }

  // Método llamado cuando cambia la selección de ciudad
  onCityChange(event: any): void {
    const cityId = +event.target.value; // Obtener el ID de la ciudad
    this.selectedCity = cityId;
    this.travelDataService.setCity(cityId); // Guardar la ciudad seleccionada
  }

  // Método para manejar el envío del formulario
  onSubmit(event: Event): void {
    event.preventDefault(); // Evita la recarga de la página

    // Verifica si se han seleccionado el país y la ciudad
    if (this.travelDataService.getCountry() === null || this.travelDataService.getCity() === null) {
      Swal.fire({
        icon: 'warning',
        title: 'Faltan datos',
        text: 'Debes seleccionar el país y la ciudad',
        confirmButtonText: 'OK'
      });
    } else {
      this.router.navigate(['screentwo']); // Navegar a la siguiente pantalla
    }
  }

  menuVisible = false; // Estado de visibilidad del menú

  // Método para alternar la visibilidad del menú
  toggleMenu() {
    this.menuVisible = !this.menuVisible;
  }

  // Método para navegar al historial
  goHistory(): void {
    // Muestra el mensaje de carga
    Swal.fire({
      title: 'Cargando...',
      text: 'Por favor, espere.',
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading();
      }
    });

    // Simula una carga de datos. Reemplaza esta parte con tu lógica de carga real.
    this.loadData().then(() => {
      // Cierra el mensaje de carga
      Swal.close();

      // Navega a la pantalla de historial
      this.router.navigate(['history']);
    }).catch(error => {
      // Cierra el mensaje de carga en caso de error
      Swal.close();

      // Muestra un mensaje de error
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Ocurrió un error al cargar los datos.',
        confirmButtonText: 'OK'
      });
    });
  }

  // Simulación de función de carga de datos
  loadData(): Promise<void> {
    return new Promise((resolve, reject) => {
      // Simula un retraso en la carga de datos (reemplaza con tu lógica real)
      setTimeout(() => {
        resolve();
      }, 2000); // Cambia el tiempo según el tiempo estimado de carga
    });
  }

  // Método para cambiar el idioma
  changeLanguage(lang: string) {
    this.translate.use(lang); // Cambiar el idioma
    localStorage.setItem('selectedLanguage', lang); // Guardar el idioma en localStorage
    this.menuVisible = this.menuVisible; // Ocultar el menú después de cambiar el idioma
  }
}
