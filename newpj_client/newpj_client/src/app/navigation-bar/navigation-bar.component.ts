import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-navigation-bar',
  templateUrl: './navigation-bar.component.html',
  styleUrl: './navigation-bar.component.css'
})
export class NavigationBarComponent implements OnInit {
  public active: string = 'border-l border-t border-r rounded-t';
  public show: boolean = true;
  ngOnInit(): void {
    console.log(location.href);
      document.getElementsByClassName('navlink')[0].className += this.active;
  }
  nextPage() {
    if (location.href == 'http://localhost:4200/')
    {
      document.getElementsByClassName('navlink')[0].className += this.active;
      document
      .getElementsByClassName('navlink')[1]
        .className = 'navlink bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold';
        document
        .getElementsByClassName('navlink')[2]
          .className='navlink bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold';
    }


    if (location.href == 'http://localhost:4200/post')
    {
      document.getElementsByClassName('navlink')[1]
        .className =
        'navlink bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold border-l border-t border-r rounded-t';
      document
        .getElementsByClassName('navlink')[0]
        .className = 'navlink bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold';
        document
        .getElementsByClassName('navlink')[2]
          .className='navlink bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold';
    }
    if (location.href == 'http://localhost:4200/login')
    {
      document.getElementsByClassName('navlink')[2]
        .className =
        'navlink bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold border-l border-t border-r rounded-t';
      document
        .getElementsByClassName('navlink')[0]
        .className = 'navlink bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold';
        document
        .getElementsByClassName('navlink')[1]
          .className='navlink bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold';
    }
  }
}
