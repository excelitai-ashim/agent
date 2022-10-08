@extends('layouts.back-end.app')
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
<style>
    table {
        min-width: max-content;
    }
</style>
<link href="{{asset('assets/back-end/css/bootstrap.min.css')}}" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
@php
    $q   = isset($_GET['q']) ? $_GET['q'] : null;
@endphp
@section('title')
    Agent -Bank Page
@endsection

@section('content')
    <div class="content-wrapper" id="app">
        <div class="container-fluid">

            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- Search -->
                            <form>
                                <div class="input-group input-group-merge input-group-flush">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tio-search"></i>
                                        </div>
                                    </div>
                                    <input id="search" type="search" class="form-control"
                                           placeholder="Search Brands" aria-label="Search orders"/>
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </form>

                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
                                Add Bank Details
                            </button>

                        </div>
                        <div class="card-body" style="padding: 0">
                            <div class="table-responsive">
                                <table style="text-align: left;"
                                       class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Sl</th>
                                        <th scope="col">Short Name</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Routing Number</th>
                                        <th scope="col" style="width: 100px" class="text-center">
                                            Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(item, index) in lists" :key="item.id">
                                        <td>@{{  index + 1 }}</td>
                                        <td>@{{  item.short_name }}</td>
                                        <td>@{{  item.full_name }}</td>
                                        <td>@{{  item.code }}</td>
                                        <td>@{{  item.routing_number }}</td>
                                        <td>
                                            <button @click.prevent="editData(item.id)" type="button"
                                                    class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#editModal">
                                                <i class="tio-edit"></i> Edit</button>

                                            <button @click.prevent="deleteData(item.id)"
                                                    class="btn btn-danger btn-sm deleteBtn">
                                                <i class="tio-add-to-trash"></i>
                                                delete
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Model Start --}}
        {{-- add Bank model Start --}}
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h3 class="modal-title mb-3" id="exampleModalLabel">Add Bank Details</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="saveData()">
                            @csrf
                            <fieldset>
                                <p v-if="errors.length">
                                    <b class="text-bg-danger">Please correct the following error(s):</b>
                                    <ul>
                                        <li class="text-danger fw-bold" v-for="error in errors">
                                            @{{ error }}
                                        </li>
                                    </ul>
                                </p>
                                <div class="mb-3">
                                    <label for="short_name" class="text-dark">Short Name</label>
                                    <input type="text" v-model="form.short_name" class="form-control bg-white" id="short_name" placeholder="Enter Short Name"  />
                                </div>
                                <div class="mb-3">
                                    <label for="full_name" class="text-dark">Full Name</label>
                                    <input type="text" v-model="form.full_name" class="form-control" id="full_name" placeholder="Enter Full Name" >
                                </div>
                                <div class="mb-3">
                                    <label for="code" class="text-dark">Code</label>
                                    <input type="text" v-model="form.code" id="code" class="form-control"
                                           placeholder="Enter Code" >
                                </div>
                                <div class="mb-3">
                                    <label for="routing_number" class="text-dark">Routing Number</label>
                                    <input type="number" v-model="form.routing_number" id="routing_number" class="form-control"
                                           placeholder="Enter Routing" >
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary" id="hideModal">Save changes</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="modal-footer  bg-light">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- addBank model End --}}

        {{-- edit Bank model Start --}}
        <div class="modal fade fadeEdit" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h3 class="modal-title mb-3" id="exampleModalLabel">Edit Bank Details</h3>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="updateData(form.id)">
                            @csrf
                            <fieldset>
                                <p v-if="errors.length">
                                    <b class="text-bg-danger">Please correct the following error(s):</b>
                                    <ul>
                                        <li class="text-danger fw-bold" v-for="error in errors">
                                            @{{ error }}
                                        </li>
                                    </ul>
                                </p>
                                <div class="mb-3">
                                    <label for="short_name" class="text-dark">Short Name</label>
                                    <input type="text" v-model="form.short_name" class="form-control bg-white" id="short_name" placeholder="Enter Short Name"  />
                                </div>
                                <div class="mb-3">
                                    <label for="full_name" class="text-dark">Full Name</label>
                                    <input type="text" v-model="form.full_name" class="form-control" id="full_name" placeholder="Enter Full Name" >
                                </div>
                                <div class="mb-3">
                                    <label for="code" class="text-dark">Code</label>
                                    <input type="text" v-model="form.code" id="code" class="form-control"
                                           placeholder="Enter Code" >
                                </div>
                                <div class="mb-3">
                                    <label for="routing_number" class="text-dark">Routing Number</label>
                                    <input type="number" v-model="form.routing_number" id="routing_number" class="form-control"
                                           placeholder="Enter Routing" >
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary" id="">Update</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="modal-footer  bg-light">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- editBank model End --}}


    </div>

    @push('script')
        <script>
            const app = new Vue({
                el: '#app',
                data:{
                    lists:[],
                    errors:[],
                    form:{
                        id:"",
                        short_name:"",
                        full_name:"",
                        code:"",
                        routing_number:""
                    }
                },

                methods: {

                    viewData : function(){
                        axios.get("/bank-details-show/")
                            .then(response=>{
                                this.lists = response.data.bank;
                                // window.location.reload();
                            })
                    },

                    checkForm : function (){
                        if(this.form.short_name== ""){
                            this.errors.push('short name field is required')
                        }
                        if(this.form.full_name== ""){
                            this.errors.push('full name field is required')
                        }
                        if(this.form.code == ""){
                            this.errors.push('code field is required')
                        }
                        if(this.form.routing_number == ""){
                            this.errors.push('routing number field is required')
                        }
                    },

                    cleanError : function (){
                        this.errors =[];
                    },
                    clearData: function(){
                        this.form.short_name = ('')
                        this.form.full_name = ('')
                        this.form.code = ('')
                        this.form.routing_number = ('')
                    },

                    saveData:function (event) {
                        this.cleanError();
                        this.checkForm();
                        if(this.errors.length === 0){
                            axios.post('/bank-details-store/' , this.form)
                                .then(() =>{

                                    // window.location.reload();
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Bank Details Added Successfully',
                                        showConfirmButton: false,
                                        timer: 1600
                                    })

                                    this.viewData();
                                    this.clearData();
                                    $('#addModal').trigger('click');

                                })
                                .catch((error) =>(this.errors.push = error.response.data.errors));

                        }
                    },

                    deleteData: function (id){
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then(response=>{
                            if (response.isConfirmed) {
                                axios.delete(`/bank-details-delete/${id}`)
                                    .then(response => {
                                        this.viewData();
                                        Swal.fire(
                                            'Deleted!',
                                            'Your file has been deleted.',
                                            'success'
                                        )
                                    });
                            }
                            })
                    },

                    editData: function (id){
                        axios.get(`/bank-details-edit/${id}`)
                            .then(response=>{
                                bank = response.data.bank
                                    this.form.id                = bank.id
                                    this.form.short_name        = bank.short_name
                                    this.form.full_name         = bank.full_name
                                    this.form.code              = bank.code
                                    this.form.routing_number    = bank.routing_number
                            })
                    },


                    updateData:function (id){
                        axios.put(`/bank-details-update/${id}`, this.form)
                            .then(response=>{
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Data Updated Successfully',
                                    showConfirmButton: false,
                                    timer: 1600,
                                })

                                this.viewData();
                                this.clearData();
                                $('#editModal').trigger('click');
                            })
                    },
                },



                mounted(){
                    this.viewData()
                }
            });


            $("#hideModal").click(function() {

                $(".fade").hide(2000);

            });
            $("#hideModalEdit").click(function() {

                $(".fadeEdit").hide(2000);
            });
            $('#search').on('keyup',function(){
                // var s = document.getElementById("#searchi")
                $value=$(this).val();
                $.ajax({
                    type : 'get',
                    url : '{{URL::to('data-search')}}',
                    data:{'search':$value},
                    success:function(data){
                        $('tbody').html(data);
                    }
                });
            })


            $(".deleteBtn").click(function (){
                var id = this.item.id;
                alert(id)
                $.ajax({
                    type : 'delete',
                    url : '/bank-details-delete/'+id,
                    data:{'search':$value},
                    success:function(data){

                    }
                });
            })

        </script>
        <script type="text/javascript">
            $.ajaxSetup({ headers: { '_token' : '{{ csrf_token() }}' } });
        </script>
    @endpush


@endsection
{{--test--}}
