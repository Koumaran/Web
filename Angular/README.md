Angular

to add bootsrap install it with npm and add it in angular-cli.json file ( whith styles from node_module)

Différent way to call a component.
@component({
    selector: '[app-server]',  => for <div app-server></div>
    selector: '.app-server',  => for <div class="app-server"></div>
    selector: 'app-server',  => for <app-server></app-server>
})

To name an Observable variable:
    myObservable$  => $ at then end of the name

Date Binding:
    String interpolation : {{ variable }} or {{ 'message' }} or
                            {{ fonction() }}
    Property Binding: <button [disabled]="!allowButton"></button>
            Here with the [] we bind an attibute of the button and set it if the variable allowButton is true.
    Event Binding: <button (click)="fonctionName()">
            Here we bind event by () and the name of the event inside.
    Two-Way Binding: <input [(ngModel)]="variable">
            Here you can modify the variable to change the input value or the input to change the variable value.
            !! don't forget to import 'FormsModule' from @angular/forms to use ngModel.

Binding from component to other component :
    send from parent to child : 
        in parent.html : <app-child  [attribute]="varialbe">
        in child.component:   @Input() element: typeOfElement;  
                ==> @Input('aliasElement') is for alias the name of the Attribute from parent.

    send from child to parent by event:
        in parent.html : <app-child (eventName)="function()">
        in child : 
            @Output('AliasEvent') element = new EventEmitter<typeofElement>();


Directive:
    *ngIf: <p *ngIf="variable; else templateName">
           <ng-template #templateName>
    ngStyle: <p [ngStyle]="{backgroundColor: getColor()}">
        Here we use camalCase javascript code
    ngClass: <p [ngClass]="{className: variable === 'text'}">
    *ngFor: *ngFor="let element of elements; let i = index"
        Here we loop like the Foreach and we can get the index in i

    <ng-content></ng-content> : Show content added in the midle of component balises.
        ex: <app-child>content</app-child> 
            ==> utiliser <ng-content> show 'content' in the component child

LifeCycle: 
    ngOnChanges : Called after a bound input property changes
    
    ngOnInit : Called once the component is initialized ( after constructor )
    
    ngDoCheck : Called during every change detection run (like on press button   anyway if the button do nothing)
    
    ngAfterContentInit: Called after content (ng-content) has been checked
    
    ngAfterContentChecked : Called evry time the projected content has been checked.
    
    ngAfterViewInit: Called after the component's view (and child views) has been initialized.

    ngAfterViewChecked: Called every time the view (and child views) have been checked.

    ngOnDestroy: Called once the component (evrythinks) is about to be destroyed.