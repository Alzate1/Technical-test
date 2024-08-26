import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class CurrencyService {
private apiUrl='http://localhost:8000/api/history';

  constructor(private http:HttpClient){

  }
  saveTravelData(amountCop:number,countryId:number,cityId:number,userId:number):Observable<any> {
    return this.http.post<any>(this.apiUrl, {
      amount_cop: amountCop,
      country_id: countryId,
      city_id: cityId,
      user_id: userId
    });
   }
}
