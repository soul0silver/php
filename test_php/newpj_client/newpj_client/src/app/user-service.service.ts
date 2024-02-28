import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { firstValueFrom } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class UserServiceService {
  constructor(private http: HttpClient) {}

  async login(name: string) {
    let res;
    try {
      res = await firstValueFrom(
        this.http.post('http://127.0.0.1:8000/api/login', { name: name })
      );
    } catch (err) {
      res = err;
    }
    return res;
  }

  async register(name: string) {
    let res;
    try {
    const res = await firstValueFrom(
      this.http.post('http://127.0.0.1:8000/api/register', { name: name })
      );
    }
    catch (err) {
      res = err;
    }
    return res;
  }

  async getList() {
    let uid: string | undefined;
    const infoString: string | null = localStorage.getItem('info');
    if (infoString) {
      const info = JSON.parse(infoString);
      if (info && typeof info === 'object' && 'id' in info) {
        uid = info.id;
      }
    }
    if (uid) {
      const res = await firstValueFrom(
        this.http.get('http://127.0.0.1:8000/api/post/home/' + uid)
      );
      return res;
    }
    return [];
  }
}
