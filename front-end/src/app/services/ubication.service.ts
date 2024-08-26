 import { HttpClient } from '@angular/common/http';
 import { Injectable } from '@angular/core';
 import { Observable } from 'rxjs';

 @Injectable({
   providedIn: 'root'
 })
 export class UbicationService {
 private apiUrlContry='http://localhost:8000/api/contries';
 private apiUrlCity='http://localhost:8000/api/cities';



   constructor(private http:HttpClient){

   }

      getCountries():Observable<any> {
        return this.http.get(this.apiUrlContry).pipe(res=>res);
      }
      getCities(countryId: number): Observable<any> {
        // Usar template strings para inyectar el countryId en la URL
        return this.http.get(`${this.apiUrlCity}/${countryId}`);
      }
 }
