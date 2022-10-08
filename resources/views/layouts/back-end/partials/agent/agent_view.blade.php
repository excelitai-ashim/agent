php artisan serve
@extends('layouts.back-end.app')

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
<style>
    table {
        min-width: max-content;
    }
</style>
@section('title')
    Agent -Page
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
                                    <input id="datatableSearch_" type="search" name="search" class="form-control"
                                        placeholder="Search Brands" aria-label="Search orders" value="hp"
                                        required="">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </form>
                            <!-- End Search -->
                            {{-- <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Add Agent
                            </a>  --}}
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addAgent"> Add
                                Agent</button>

                        </div>
                        <div class="card-body" style="padding: 0">
                            <div class="table-responsive">
                                <table style="text-align: left;"
                                    class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Sl</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Agent ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Registration Date</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Mobile Number 1</th>
                                            <th scope="col">Mobile Number 2</th>
                                            <th scope="col">Zone/Area</th>
                                            <th scope="col">Division</th>
                                            <th scope="col">Present Address</th>
                                            <th scope="col">Permanent Address</th>
                                            <th scope="col">Bank Name</th>
                                            <th scope="col">Account Number</th>
                                            <th scope="col">Mobile Banking</th>
                                            <th scope="col">Banking Mobile Number</th>
                                            <th scope="col">Active Status</th>
                                            <th scope="col" style="width: 100px" class="text-center">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in lists" :key="item.id">
                                            <td>@{{ index + 1 }}</td>
                                            <td> <img style="width:80px;heigth:80px;" v-bind:src="'/images/' +item.agent_info.image"
                                                    class="img-thumbnail rounded-circle" /> </td>
                                            <td>@{{ item.agent_info.agent_Autostring_id }}</td>
                                            <td>@{{ item.name }}</td>
                                            <td>@{{ item.agent_info.registration_date }}</td>
                                            <td>@{{ item.email }}</td>
                                            <td>@{{ item.agent_info.mobileNumber1 }}</td>
                                            <td>@{{ item.agent_info.mobileNumber2 }}</td>
                                            <td>@{{ item.agent_info.agent_zone_area }}</td>
                                            <td>@{{ item.agent_info.agent_division }}</td>
                                            <td>@{{ item.agent_info.present_address }}</td>
                                            <td>@{{ item.agent_info.permanent_address }}</td>
                                            <td>@{{ item.payment_details.bank_name.full_name }}</td>
                                            <td>@{{ item.payment_details.account_number }}</td>
                                            <td>@{{ item.payment_details.Mobile_banking }}</td>
                                            <td>@{{ item.payment_details.banking_mobile_number }}</td>

                                            <td>
                                                <label class="switch switch-status">
                                                    <input type="checkbox" class="status" id="31" checked="">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>

                                                <button @click.prevent="edit(item.id)" type="button"
                                                    class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#editAgent">
                                                    <i class="tio-edit"></i>Edit</button>

                                                <button @click.prevent="deleteagent(item.id)"
                                                    class="btn btn-danger btn-sm delete">
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
        {{-- addAgent model Start --}}
        <div class="modal fade" id="addAgent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Agent</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="saveAgent()">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="image">Choose Image</label>
                                    <input type="file" ref="fileInput" v-on:change="onImageChange" name="image"
                                        accept="image/*" onchange="loadFile(event)" class="form-control" required>

                                </div>
                                <div class="col">
                                    <img class="img-thumbnail rounded-circle" style="width:100px; heigth:100px;" id="output" />
                                </div>
                                <div class="col"></div>
                                <div class="col">
                                    <label for="registration_date">Registration Date</label>
                                    <input type="date" class="form-control mt-2" id="registration_date"
                                        v-model="form.registration_date" />
                                </div>
                            </div>
                            <div class="row mt-4">

                                <div class="col">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control mt-2" id="name"
                                        v-model="form.name"placeholder="Full Name" />
                                </div>

                                <div class="col">
                                    <label for="phone_one">Mobile Number 1</label>
                                    <input type="tel" class="form-control mt-2" id="phone_one"
                                        v-model="form.mobileNumber1" placeholder="+8801754XXXXXX">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <label for="phone_two">Mobile Number 2</label>
                                    <input type="tel" class="form-control mt-2" id="phone_two"
                                        v-model="form.mobileNumber2" placeholder="+8801854XXXXXX">
                                </div>
                                <div class="col">
                                    <label for="name"> Zone Area</label>
                                    <select v-model="form.agent_zone_area" id="" class="form-control  mt-2">
                                        <option value="" selected disabled>Select Zone Area</option>
                                        <option v-for="item in districts" :value="item.name">@{{ item.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="division">Division</label>
                                    <select v-model="form.agent_division" id="" class="form-control  mt-2">
                                        <option value="" selected disabled>Select Division</option>
                                        <option v-for="item in divisions" :value="item.name">@{{ item.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col"></div>
                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <label for="present_address">Present Address</label>
                                    <textarea v-model="form.present_address" class="form-control mt-2" cols="37" rows="2"></textarea>
                                </div>
                                <div class="col">
                                    <div class="col">
                                        <label for="permanent_address">Permanent Address</label>
                                        <textarea v-model="form.permanent_address" id="permanent_address" class="form-control mt-2" cols="37"
                                            rows="2" placeholder="Permanent Address"></textarea>
                                    </div>
                                </div>
                                <div class="col"></div>
                                <div class="col"></div>
                            </div>
                            <div class="row mt-4">
                                <strong>Payment Details:</strong>
                                <div class="col">
                                    <label for="bank_details" class="mt-2">Bank Name</label>
                                    <select v-model="form.bank_id" id="" class="form-control  mt-2">
                                        <option value="" selected disabled>Select Bank</option>
                                        <option v-for="item in bank" :value="item.id">@{{ item.full_name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="account_number" class="mt-2">Account Number</label>
                                    <input type="number" class="form-control mt-2" id="account_number"
                                        v-model="form.account_number" placeholder="Account Number" />
                                </div>
                                <div class="col">
                                    <label for="mobile_banking" class="mt-2">Mobile Banking</label>
                                    <input type="text" class="form-control mt-2" id="mobile_banking"
                                        v-model="form.Mobile_banking" placeholder="Mobile Banking">
                                </div>
                                <div class="col">
                                    <label for="phone" class="mt-2">Banking Mobile Number </label>
                                    <input type="tel" class="form-control mt-2" id="phone"
                                        v-model="form.banking_mobile_number" placeholder="+8801754XXXXXX">
                                </div>

                            </div>
                            <div class="row mt-4">
                                <strong>Login Details:</strong>
                                <div class="col-3">
                                    <label for="email_two" class="mt-2">Email</label>
                                    <input type="email" class="form-control mt-2" id="email_two" v-model="form.email"
                                        placeholder="Email" />
                                </div>
                                <div class="col-3">
                                    <label for="password" class="mt-2">Password</label>
                                    <input type="password" class="form-control mt-2" id="password"
                                        v-model="form.password" placeholder="Password" />
                                </div>
                                <div class="col-3"></div>
                                <div class="col-3"></div>

                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" id="hideModal" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        {{-- addAgent model End --}}

        {{-- edit Agent model Start --}}
         <div class="modal fade fadeEdit " id="editAgent" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Agent</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="updateAgent(form.id)">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="image">Choose Image</label>
                                    <input type="file" ref="fileInput" v-on:change="onImageUpdate" name="image"
                                        accept="image/*" onchange="loadFiles(event)" class="form-control" required>
                                </div>
                                <div class="col">
                                    <img class="img-thumbnail rounded-circle"
                                        style="width:100px; heigth:100px;" id="outputEdit" />
                                </div>
                                <div class="col"></div>
                                <div class="col"> </div>


                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <label for="agent_id">Agent ID</label>
                                    <input type="text" class="form-control mt-2" id="agent_id"
                                        v-model="form.agent_id" placeholder="# AG123" />
                                </div>
                                <div class="col">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control mt-2" id="name"
                                        v-model="form.name"placeholder="Full Name" />
                                </div>

                                <div class="col">
                                    <label for="phone_one">Mobile Number 1</label>
                                    <input type="tel" class="form-control mt-2" id="phone_one"
                                        v-model="form.mobileNumber1" placeholder="+8801754XXXXXX">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <label for="phone_two">Mobile Number 2</label>
                                    <input type="tel" class="form-control mt-2" id="phone_two"
                                        v-model="form.mobileNumber2" placeholder="+8801854XXXXXX">
                                </div>
                                <div class="col">
                                    <label for="name"> Zone Area</label>
                                    <select v-model="form.agent_zone_area" id="" class="form-control  mt-2">
                                        <option value="" selected disabled>Select Zone Area</option>
                                        <option v-for="item in districts" :value="item.name">@{{ item.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="division">Division</label>
                                    <select v-model="form.agent_division" id="" class="form-control  mt-2">
                                        <option value="" selected disabled>Select Division</option>
                                        <option v-for="item in divisions" :value="item.name">@{{ item.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col"></div>
                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <label for="present_address">Present Address</label>
                                    <textarea v-model="form.present_address" class="form-control mt-2" cols="37" rows="2"></textarea>
                                </div>
                                <div class="col">
                                    <div class="col">
                                        <label for="permanent_address">Permanent Address</label>
                                        <textarea v-model="form.permanent_address" id="permanent_address" class="form-control mt-2" cols="37"
                                            rows="2" placeholder="Permanent Address"></textarea>
                                    </div>
                                </div>
                                <div class="col"></div>
                                <div class="col"></div>
                            </div>
                            <div class="row mt-4">
                                <strong>Payment Details:</strong>
                                <div class="col">
                                    <label for="bank_details" class="mt-2">Bank Details</label>
                                    <input type="text" class="form-control mt-2" id="bank_details"
                                        v-model="form.bank_details" placeholder="Bank Details" />
                                </div>
                                <div class="col">
                                    <label for="account_number" class="mt-2">Account Number</label>
                                    <input type="number" class="form-control mt-2" id="account_number"
                                        v-model="form.account_number" placeholder="Account Number" />
                                </div>
                                <div class="col">
                                    <label for="mobile_banking" class="mt-2">Mobile Banking</label>
                                    <input type="text" class="form-control mt-2" id="mobile_banking"
                                        v-model="form.Mobile_banking" placeholder="Mobile Banking">
                                </div>
                                <div class="col">
                                    <label for="phone" class="mt-2">Banking Mobile Number </label>
                                    <input type="tel" class="form-control mt-2" id="phone"
                                        v-model="form.banking_mobile_number" placeholder="+8801754XXXXXX">
                                </div>

                            </div>
                            <div class="row mt-4">
                                <strong>Login Details:</strong>
                                <div class="col-3">
                                    <label for="email_two" class="mt-2">Email</label>
                                    <input type="email" class="form-control mt-2" id="email_two" v-model="form.email"
                                        placeholder="Email" />
                                </div>
                                <div class="col-3">
                                    <label for="password" class="mt-2">Password</label>
                                    <input type="password" class="form-control mt-2" id="password"
                                        v-model="form.password" placeholder="Password" />
                                </div>
                                <div class="col-3"></div>
                                <div class="col-3"></div>

                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" id="hideModalEdit" class="btn btn-primary">Update Agent</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        {{-- edit Agent model end --}}



        {{-- Model End --}}



    </div>



    @push('script')
        <script>
            const app = new Vue({
                el: '#app',
                data: {

                    lists: [],
                    districts: [],
                    divisions: [],
                    bank: [],
                    errors: [],
                    form: {
                        id: "",
                        image: "",
                        registration_date: "",
                        agent_id: "",
                        name: "",
                        mobileNumber1: "",
                        mobileNumber2: "",
                        agent_zone_area: "",
                        agent_division: "",
                        present_address: "",
                        permanent_address: "",
                        bank_id: "",
                        account_number: "",
                        Mobile_banking: "",
                        banking_mobile_number: "",
                        email: "",
                        password: "",

                    }
                },
                methods: {

                    view() {
                        axios.get("/agent/getData")
                            .then(response => {
                                this.lists = response.data.agent;
                                this.districts = response.data.districts;
                                this.divisions = response.data.divisions;
                                this.bank = response.data.bank;

                                // console.log(this.lists);



                            });
                    },
                    onImageChange(e) {
                        this.form.image = e.target.files[0];
                    },
                    onImageUpdate(e) {

                     this.form.image = e.target.files[0];
                    this.form.image = this.current.image;
                    console.log( this.form.image);

                },
                    saveAgent() {
                        const config = {
                            headers: {
                                'content-type': 'multipart/form-data'
                            }
                        }

                        // this.cleanError();
                        // this.checkForm();
                        // if(this.errors.length === 0) {
                        axios
                            .post("/agent/store_data/", this.form, config)
                            .then(() => {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Customer added successfully',
                                    showConfirmButton: false,
                                    timer: 3500
                                })
                                this.view();
                            })
                            .catch((error) => (this.errors.push = error.response.data.errors));
                        // }
                    },

                    id: "",
                    image: "",
                    registration_date: "",
                    agent_id: "",
                    name: "",
                    mobileNumber1: "",
                    mobileNumber2: "",
                    agent_zone_area: "",
                    agent_division: "",
                    present_address: "",
                    permanent_address: "",
                    bank_details: "",
                    account_number: "",
                    Mobile_banking: "",
                    banking_mobile_number: "",
                    email: "",
                    password: "",


                    edit(agent_id) {
                        const config = {
                            headers: {
                                'content-type': 'multipart/form-data'
                            }
                        }
                        axios.get(`/agent/edit/${agent_id}`)
                            .then(response => {
                                agent = response.data.agent;
                                this.form.id = agent.id
                                this.form.image = agent.image
                                this.form.registration_date = agent.registration_date
                                this.form.agent_id = agent.agent_id
                                this.form.name = agent.name
                                this.form.mobileNumber1 = agent.mobileNumber1
                                this.form.mobileNumber2 = agent.mobileNumber2
                                this.form.agent_zone_area = agent.agent_zone_area;
                                this.form.agent_division = agent.agent_division
                                this.form.present_address = agent.present_address
                                this.form.permanent_address = agent.permanent_address
                                this.form.bank_details = agent.bank_details
                                this.form.account_number = agent.account_number
                                this.form.Mobile_banking = agent.Mobile_banking
                                this.form.banking_mobile_number = agent.banking_mobile_number
                                this.form.email = agent.email;
                                this.form.password = agent.password;
                            });
                    },
                                 updateAgent(agent_id){
                                    const config = {
                            headers: {
                                'content-type': 'multipart/form-data'
                                    }
                                    }
                                    axios
                                    .post(`/agent/update/${agent_id}`,this.form,config)
                                    .then(response=>{
                                        // this.view();

                                        let listData=this.form;

                                        this.lists.map(function(obj,index){
                                            if(obj.id==customer_id){
                                                 this.lists.$set(index, listData);
                                                // lists[index].customer_id = this.form.customer_id;
                                                // console.log(this.lists[index].customer_id);

                                            }
                                            })


                                    })
                                },


                    deleteagent(agent_id) {

                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {

                                axios.get(`/agent/remove/${agent_id}`)
                                    .then(response => {

                                        this.view();
                                        Swal.fire(
                                            'Deleted!',
                                            'Your file has been deleted.',
                                            'success'
                                        )
                                    });
                            }
                        })
                    },

                    //         cleanError : function(){
                    //     this.errors = [];
                    //   },
                    //   checkForm : function(){
                    //         if (this.form.customer_id==" ") {
                    //           this.errors.push('customer_id is required.');
                    //         }
                    //         if (this.form.customer_name==" ") {
                    //           this.errors.push('customer_name is required.');
                    //         }
                    //         if (this.form.customer_email==" ") {
                    //           this.errors.push('customer_email is required.');
                    //         }
                    //         if (this.form.customer_mobile==" ") {
                    //           this.errors.push('customer_mobile is required.');
                    //         }
                    //         if (this.form.customer_division==" ") {
                    //           this.errors.push('customer_division is required.');
                    //         }
                    //         if (this.form.customer_area==" ") {
                    //           this.errors.push('customer_area is required.');
                    //         }
                    //         if (this.form.customer_address==" ") {
                    //           this.errors.push('customer_address is required.');
                    //         }

                    //   },


                },
                mounted() {
                    this.view();
                }
            })

            // ===========Add from data===============

            $("#hideModal").click(function() {

                $(".fade").hide(2000);
            });

            var loadFile = function(event) {
                var output = document.getElementById('output');
                output.src = URL.createObjectURL(event.target.files[0]);
                woutput.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            };
            // ===========Add from data===============

            // ===========edit from data===============
            $("#hideModalEdit").click(function() {

                $(".fadeEdit").hide(2000);
            });


            // ===========edit from data===============
        </script>
        <Script>
               var loadFiles = function(event) {
                var output = document.getElementById('outputEdit');
                output.src = URL.createObjectURL(event.target.files[0]);
                woutput.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            };
        </Script>
    @endpush

    </body>

    </html>
@endsection
