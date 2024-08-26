import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { Router, RouterOutlet } from '@angular/router';
import { HistoryService } from '../../services/history.service';
import { HistoryItem } from '../../interfaces/history';
import { TranslateModule, TranslateService } from '@ngx-translate/core';
import Swal from 'sweetalert2';

@Component({
  selector: 'history-root',
  standalone: true,
  imports: [RouterOutlet, CommonModule, TranslateModule],
  templateUrl: './history.component.html',
  styles: '' // Estilos vacíos; puedes agregar estilos aquí si es necesario
})
export class HistoryComponent implements OnInit {

  historyList: HistoryItem[] = []; // Lista para almacenar los elementos del historial

  // Constructor para inyectar las dependencias
  constructor(
    private historyService: HistoryService,
    private router: Router,
    private translate: TranslateService
  ) {}

  // Método que se ejecuta al inicializar el componente
  ngOnInit(): void {
    this.loadHistory(); // Cargar el historial al iniciar
    this.translate.use(this.translate.currentLang); // Establecer el idioma actual para la traducción
  }

  // Método para cargar el historial desde el servicio
  loadHistory(): void {
    // Muestra el mensaje de carga
    Swal.fire({
      title: 'Cargando...',
      text: 'Por favor, espere.',
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading();
      }
    });

    // Llama al servicio para obtener el historial
    this.historyService.getHistory().subscribe({
      next: data => {
        this.historyList = data; // Asigna los datos obtenidos a la lista de historial

        // Cierra el mensaje de carga después de recibir los datos
        Swal.close();
      },
      error: error => {
        console.error('Error al obtener el historial', error); // Manejar posibles errores

        // Cierra el mensaje de carga en caso de error
        Swal.close();

        // Muestra un mensaje de error
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Ocurrió un error al obtener el historial.',
          confirmButtonText: 'OK'
        });
      }
    });
  }

  // Método para redirigir al usuario a la pantalla de inicio
  goBack(): void {
    this.router.navigate(['']); // Navegar a la ruta principal
  }
}
