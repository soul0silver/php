import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { firstValueFrom } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class PostServiceService {
  public post = {
    id:0,
    name: '',
    uid: 0,
    content: '',
  };
  constructor(private http: HttpClient) {}

  setData(data: any) {
    this.post = data;
  }
  getData() {
    return this.post;
  }

  async create(data:any) {
    let res = await firstValueFrom(
      this.http.post('http://127.0.0.1:8000/api/post/create', data)
    );
    return res;
  }
  async edit(data:any) {
    let res = await firstValueFrom(
      this.http.post('http://127.0.0.1:8000/api/post/edit', data)
    );
    return res;
  }
}
