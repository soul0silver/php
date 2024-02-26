import { Component } from '@angular/core';
import { UserServiceService } from '../user-service.service';
import { FormBuilder, FormControl, FormGroup } from '@angular/forms';
import { JsonPipe } from '@angular/common';
import { Router } from '@angular/router';

@Component({
  selector: 'app-user-page',
  templateUrl: './user-page.component.html',
  styleUrl: './user-page.component.css',
})
export class UserPageComponent {
  public formLogin: FormGroup = new FormGroup({
    name: new FormControl(''),
  });
  constructor(private api: UserServiceService, private router: Router) {}
  login() {
    this.api.login(this.formLogin.value.name).then((res: any) => {
      console.log(res);
      if (res.status === 200) {
        localStorage.setItem('info', JSON.stringify(res.data[0]));
        this.router.navigate(['']);
      }
    });
  }
}
