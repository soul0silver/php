import { Component, OnInit } from '@angular/core';
import { PostServiceService } from '../post-service.service';
import { FormControl, FormGroup } from '@angular/forms';
@Component({
  selector: 'app-edit',
  templateUrl: './edit.component.html',
  styleUrl: './edit.component.css',
})
export class EditComponent implements OnInit {
  public data: any;
  public postInfo: FormGroup;
  public active: string = 'border-l border-t border-r rounded-t';

  constructor(private post: PostServiceService) {
    let uid: number | undefined;
    const infoString: string | null = localStorage.getItem('info');
    if (infoString) {
      const info = JSON.parse(infoString);
      if (info && typeof info === 'object' && 'id' in info) {
        uid = Number(info.id);
      }
    }
    this.data = post.getData();
    this.postInfo = new FormGroup({
      name: new FormControl(this.data.name),
      uid: new FormControl(uid),
      content: new FormControl(this.data.content),
    });
  }

  ngOnInit(): void {
    console.log(1);
    if (location.href == 'http://localhost:4200/post') {
      document.getElementsByClassName('navlink')[1].className += this.active;
      document.getElementsByClassName('navlink')[0].className =
        'navlink bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold';
      document.getElementsByClassName('navlink')[2].className =
        'navlink bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold';
    }
  }

  edit() {
    this.post.edit(this.postInfo.value).then((res: any) => {
      console.log(res);
      alert(res.message);
    });
  }
}
