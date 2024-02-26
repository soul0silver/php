import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { UserServiceService } from '../user-service.service';
import { PostServiceService } from '../post-service.service';

@Component({
  selector: 'app-home-page',
  templateUrl: './home-page.component.html',
  styleUrl: './home-page.component.css',
})
export class HomePageComponent implements OnInit {
  public active: string = 'border-l border-t border-r rounded-t';
  public data: any[] = [];
  constructor(
    private router: Router,
    private api: UserServiceService,
    private state: PostServiceService
  ) {}
  ngOnInit(): void {
    if (location.href == 'http://localhost:4200/') {
      document.getElementsByClassName('navlink')[0].className += this.active;
      document.getElementsByClassName('navlink')[1].className =
        'navlink bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold';
      document.getElementsByClassName('navlink')[2].className =
        'navlink bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold';
    }

    this.api.getList().then((res: any) => {
      this.data = res.data;
      console.log(res);
    });
  }
  setData(data: any) {
    this.state.setData(data);
    this.router.navigate(['post/edit']);
  }
}
