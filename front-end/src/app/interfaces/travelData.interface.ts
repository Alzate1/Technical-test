  import { Injectable } from '@angular/core';

  @Injectable({
    providedIn: 'root'
  })
  export class TravelDataService {
    private country: number | null = null;
    private city: number | null = null;
    private amout_cop: number | null = null;
    private dates:any=null;

    constructor() { }

    // Métodos para establecer los valores
    setCountry(country: number) {
      this.country = country;
    }

    setCity(city: number) {
      this.city = city;
    }

    setAmount(amout_cop: number) {
      this.amout_cop = amout_cop;
    }
    setDates(dates:any){
      this.dates=dates;
    }
    // Métodos para obtener los valores
    getCountry(): number | null {
      return this.country;
    }

    getCity(): number | null {
      return this.city;
    }

    getAmout(): number | null {
      return this.amout_cop;
    }
    getDates():any{
      return this.dates;
    }
    // Método para resetear todos los valores (opcional)
    resetData() {
      this.country = null;
      this.city = null;
      this.amout_cop = null;
      this.dates=null;
    }
  }
