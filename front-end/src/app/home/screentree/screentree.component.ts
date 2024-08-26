import { Component, OnInit } from '@angular/core';
import { Router, RouterOutlet } from '@angular/router';
import { TravelDataService } from '../../interfaces/travelData.interface';
import { CommonModule } from '@angular/common';
import { TranslateModule, TranslateService } from '@ngx-translate/core';

@Component({
  selector: 'screenthree-root',
  standalone: true,
  imports: [RouterOutlet, CommonModule, TranslateModule],
  templateUrl: './screenthree.component.html',
  styles: '' // Estilos vacíos; puedes agregar estilos aquí si es necesario
})
export class ScreenThreeComponent implements OnInit {
  country: string | null = null; // Nombre del país
  city: string | null = null; // Nombre de la ciudad
  amountCop: number | null = null; // Monto en pesos colombianos
  temperature: string | null = null; // Temperatura actual en la ciudad
  currencyName: string | null = null; // Nombre de la moneda local
  currencySymbol: string | null = null; // Símbolo de la moneda local
  convertedAmount: string | null = null; // Monto convertido a la moneda local
  exchangeRate: number | null = null; // Tasa de cambio usada para la conversión

  // Constructor para inyectar dependencias
  constructor(
    private travelDataService: TravelDataService,
    private router: Router,
    private translate: TranslateService
  ) {}

  ngOnInit(): void {
    // Obtener los datos del servicio de datos de viaje
    const data = this.travelDataService.getDates();
    if (data) {
      this.country = data.country; // Asignar el país
      this.city = data.city; // Asignar la ciudad
      this.amountCop = data.amount_cop; // Asignar el monto en pesos colombianos
      this.temperature = data.temperature; // Asignar la temperatura
      this.currencyName = data.currency_name; // Asignar el nombre de la moneda
      this.currencySymbol = data.currency_symbol; // Asignar el símbolo de la moneda
      this.convertedAmount = data.converted_amount; // Asignar el monto convertido
      this.exchangeRate = data.exchange_rate; // Asignar la tasa de cambio
    }

    // Establecer el idioma actual para la traducción
    this.translate.use(this.translate.currentLang);
  }

  // Método para manejar el envío del formulario (o clic en botón)
  onSubmit(): void {
    this.router.navigate(['']); // Navegar a la ruta principal (puedes ajustar según sea necesario)
  }
}
