import { Component, OnInit, ViewChild,TemplateRef} from '@angular/core';
import { ServicesService } from '../services/services.service';
import { NgxSpinnerService } from 'ngx-spinner';
import {environment} from '../../environments/environment';
import swal from 'sweetalert2';
import { Router, ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-user-list',
  templateUrl: './user-list.component.html',
  styleUrls: ['./user-list.component.css']
})
export class UserListComponent implements OnInit {

  public loading = false;
  isLoader: boolean = false;
  public displayList:boolean = false;
  apiBaseUrl = environment.apiBaseUrl;
  totaluser = 0;
  spinLoader = {
    filter : false,
    delete : []
  };

  isListData=true;
  isOnePage=false;
  userDataPacket;

  constructor(private _services: ServicesService, private router: Router) {

  }


  ngOnInit() {
    this.getPageRequest();
  }

  fields = [
    {
      'field': 'first_name',
      'title': 'Name',
      'width': '20%',
      'code':true,
      'sort':false
    },
    {
      'field': 'last_name',
      'title': 'Surname',
      'width': '20%',
      'code':true,
      'sort':false
    },
    {
      'field': 'email_id',
      'title': 'Email address',
      'width': '25%',
      'code':true,
      'sort':false
    },
    {
      'field': 'contact_no',
      'title': 'Mobile number',
      'width': '25%',
      'code':true,
      'sort':false
    }

  ]


  resetSearchField(){
    this.spinLoader['filter'] = true;
    this.getPageRequest();
  }

  getSearchRequest(){
    this.spinLoader['filter'] = true;
    this.getPageRequest();
  }

  sortType : string = '';
  sortField: string = '';
  oldField: string;
  sortingData= {
    'field' : '',
    'type'  : ''
  };

  sortBy(field, event){

    this.oldField = (this.oldField != field) ? this.oldField : field;

    if(typeof this.oldField !== 'undefined'){
      //console.log(document.getElementById('fa-'+this.oldField));

      document.getElementById('fa-'+this.oldField).classList.remove('fa-sort-up');
      document.getElementById('fa-'+this.oldField).classList.remove('fa-sort-down');
      document.getElementById('fa-'+this.oldField).classList.add('fa-sort');
    }

    event.target.classList.add('fa');

    this.sortField = field;
    this.sortType = (this.sortType == 'desc') ? 'asc' : 'desc';

    switch(this.sortType){
      case 'desc' : {
        event.target.classList.remove('fa-sort-up');
        event.target.classList.add('fa-sort-down');
        this.oldField = field;
      }break;
      case 'asc'  : {
        event.target.classList.remove('fa-sort-down');
        event.target.classList.add('fa-sort-up');
        this.oldField = field;
      }break;
      default     : {
        event.target.classList.add('fa-sort');
      }
    }

    this.sortingData = {
      'field' : this.sortField,
      'type'  : this.sortType
    };


    this.getPageRequest();
  }

  /*------------------------------Table with Sorting Ends Here--------------------------*/

  /*------------------------------Pagination Integration Starts Here------------------------*/
  currentPage: number = 1;
  loader: boolean = false;
  paginate= {
    'last_page' : 1
  };
  route:string;
  searchFields= [];
  pages: any;
  listData = [];
  editData: Object = {};

  previousPage(){
    if(this.currentPage == 1){
      return;
    }

    this.currentPage = this.currentPage -1;
    //console.log(this.currentPage);return;
    this.getPageRequest();

  }

  nextPage() {
    if (this.paginate.last_page-1 < this.currentPage) {
      return;
    }

    this.currentPage ++;
    console.log(this.currentPage);
    this.getPageRequest();
  }

  changePage(){
    this.currentPage = this.currentPage;
    //console.log(this.currentPage);return;
    this.getPageRequest();
  }

  getPages(n){
    if(n>1){
      this.isOnePage=true;
    }else{
      this.isOnePage=false;
    }
    var data = [];
    for (var i = 1; i <= n; i++) {
      data.push(i);
    }
    this.pages = data;
  }
  /*------------------------------Pagination Integration Starts Here------------------------*/

  getPageRequest(){

    this.route  = 'get-user-list';

    switch(this.route){

      case 'get-user-list' :{
        var data = {
          page  : this.currentPage,
          search: {
            'first_name' : this.searchFields['first_name']
          },
          sort  : this.sortingData
        };
      }
        break;
    }

    this.loading = true;

    const token    = localStorage.getItem('userToken');
    this._services.requestCreator(data, this.route, token).subscribe((result: any) => {

      this._services.checkToken(result.status);

      this.spinLoader['filter'] = false;
      this.isListData=false;

      this.listData = [];
      this.listData = result.result;
      console.log(this.listData);
      this.paginate = result.paginate;
      this.totaluser = result.paginate.total;

      this.currentPage = result.paginate.current_page;

      if(result.paginate.current_page > result.paginate.last_page){
        this.currentPage = result.paginate.last_page;
      }

      this.getPages(this.paginate.last_page);

      for (let key in this.spinLoader) {
        if(key == 'delete'){
          this.spinLoader[key] = [];
        }else{
          this.spinLoader[key] = false;
        }
      }
    });
    return true;
  }

  /*--------------------------Delete User starts------------------------*/

  deleteUser(id){
    //this.loading = true;

    // Inside For Swal .fire needed for angular 7 and above version	
    swal.fire({
      title: 'Are you sure?',
      text: 'You want to delete this user',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#163862',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes'
    }).then((result) => {

      if(result.value){
        this.spinLoader.delete[id] = true;
        this._services.requestCreator(
            {id : id},
            'delete-user',
            localStorage.getItem('userToken')
        ).subscribe((result: any) => {

          //this.loading = false;

          //this.viewJobData = response.paginate.data;
          this.getPageRequest();
        });
      }
    })

  }

  /*--------------------------Delete User Ends------------------------*/
  
  userIsActive(userId,userEmail,userActiveVal){
    // console.log(userActiveVal);
    var userAction = 'activate';
    var isActive = 1;
    if(userActiveVal === true){
      userAction = 'activate';
      isActive = 1;
    }else{
      userAction = 'deactivate';
      isActive = 0;
    }

    let data = {
      id: userId,
      status: isActive
    };
    swal.fire({
      title: 'Are you sure?',
      text: 'You want to '+userAction+' user details of '+userEmail,
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#163862',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes'
    }).then((result) => {
      console.log(result);
      if (result.value==true) {
        this.route  = 'user-activation';
        const token    = localStorage.getItem('userToken');
        this.spinLoader['filter'] = true;
        this._services.requestCreator(data, this.route, token).subscribe((result: any) => {
          this.loading = false;
          this.getPageRequest();
          // this.spinLoader['filter'] = false;
        });
      }else{
        this.getPageRequest();
        // this.spinLoader['filter'] = false;
      }
    });
  }

}
