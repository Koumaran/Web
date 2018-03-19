import { Component, OnInit } from '@angular/core';
import { UsersService } from './users.service';

// model
import { User } from './users.model';

@Component({
  selector: 'app-users',
  templateUrl: './users.component.html',
  styleUrls: ['./users.component.css']
})
export class UsersComponent implements OnInit {

  users: User;

  constructor(private userService: UsersService) { }

  ngOnInit() {
    this.userService.getUsers()
        .subscribe(users => {
          this.users = users;
        });
  }

}
