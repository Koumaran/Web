import { Component, OnInit } from '@angular/core';

import { Ingridient } from '../shared/ingredient.model';

@Component({
  selector: 'app-shopping-list',
  templateUrl: './shopping-list.component.html',
  styleUrls: ['./shopping-list.component.css']
})
export class ShoppingListComponent implements OnInit {

  ingridients: Ingridient[] = [
    new Ingridient('Apples', 5),
    new Ingridient('Tomato', 3)
  ];

  constructor() { }

  ngOnInit() {
  }

}
