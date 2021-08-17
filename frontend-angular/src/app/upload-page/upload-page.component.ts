import { Component, OnInit } from '@angular/core';
import { DomSanitizer } from '@angular/platform-browser';
import {RestService}

@Component({
  selector: 'app-upload-page',
  templateUrl: './upload-page.component.html',
  styleUrls: ['./upload-page.component.css']
})

export class UploadPageComponent implements OnInit {
  public archivos: any = []
  public previsualizacion: string;
  public loading: boolean;

  constructor(private sanitizer: DomSanitizer, private rest: RestService)   { }

  ngOnInit(): void {
  }

  capturarFile(event): any {
    const archivoCapturado = event.target.files[0]
    this.extraerBase64(archivoCapturado).then(imagen => {
      this.previsualizacion = imagen.base;
      console.log(imagen );
    })
    this.archivos.push(archivoCapturado)
    //console.log(event.target.files);
  }

  extraerBase64 = async ($event: any) => new Promise((resolve, reject) =>{
    try {
      const unsafeImg = window.URL.createObjectURL($event);
      const image = this.sanitizer.bypassSecurityTrustUrl(unsafeImg);
      const reader = new FileReader();
      reader.readAsDataURL($event);
      reader.onload = () => {
        resolve({
          base: reader.result

        });
      };
      reader.onerror = error => {
        resolve({
          base: null
        });
      };

    }catch (e) {
      return null;
    }
  })

  SubirArchivo(): any {
    try {
      this.loading = true;
      const formulariodeDatos = new FormData();
      this.archivos.forEach(archivo => {
        formulariodeDatos.append('files', archivo)
      })

      //formulariodeDatos.append('id', archivo)
      

      this.rest.post('http://localhost:8000/api/articules/upload', formulariodeDatos)
        .subscribe(res => {
          this.loading = false;
          console.log('Respuesta del servidor', res);
        })
      
    } catch (e) {
      this.loading = false;
      console.log('ERROR', e);
    }
  }
}