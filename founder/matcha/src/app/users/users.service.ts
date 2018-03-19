import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs/Observable';

import { User } from './users.model';

@Injectable()
export class UsersService {

  private usersUrl = 'localhost:8000/api/users';

  constructor(private http: HttpClient) { }

  getUsers() {
    return this.http.get<User>(this.usersUrl);
  }


}
