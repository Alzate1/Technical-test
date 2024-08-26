import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class HistoryService {
private apiUrl='http://localhost:8000/api/getHistory';

  constructor(private http:HttpClient){

  }
  getHistory():Observable<any> {
    return this.http.get(this.apiUrl);
   }
}
