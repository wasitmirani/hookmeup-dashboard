<template>
  <div>

                <!-- Dashboard Analytics Start -->
                <section id="dashboard-analytics">
                    <div class="row match-height">
                        <!-- Greetings Card starts -->
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="card card-congratulations">
                                <div class="card-body text-center">
                                    <img src="app-assets/images/elements/decore-left.png" class="congratulations-img-left" alt="card-img-left" />
                                    <img src="app-assets/images/elements/decore-right.png" class="congratulations-img-right" alt="card-img-right" />
                                    <div class="avatar avatar-xl bg-primary shadow">
                                        <div class="avatar-content">
                                            <i data-feather="user" class="font-large-1"></i>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <h1 class="mb-1 text-white">Hi, {{authuser.name}}</h1>
                                        <p class="card-text m-auto w-75">
                                            <!-- You have done <strong>57.6%</strong> more sales today. Check your new badge in your profile. -->
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Greetings Card ends -->
                          <div class="col-lg-8 col-12">
      <div class="card card-statistics">
        <div class="card-header">
          <h4 class="card-title">Users</h4>
          <div class="d-flex align-items-center">
            <!-- <p class="card-text me-25 mb-0">Updated 1 month ago</p> -->
          </div>
        </div>
        <div class="card-body statistics-body">
          <div class="row">
            <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary p-50 m-0">
                                        <div class="avatar-content">
                                           <i  class="fas fa-users font-medium-5"></i>
                                        </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">{{dashboard.users.total}}</h4>
                  <p class="card-text font-small-3 mb-0">Users</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
              <div class="d-flex flex-row">
               <div class="avatar bg-light-primary p-50 m-0">
                                        <div class="avatar-content">
                                   <i  class="fas fa-users font-medium-5"></i>
                </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">{{dashboard.users.free_members}}</h4>
                  <p class="card-text font-small-3 mb-0">Free Membership</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12 mb-2 mb-sm-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-success p-50 m-0">
                    <div class="avatar-content">
                 <i  class="fas fa-users font-medium-5"></i>
                </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">{{dashboard.users.customize_members}}</h4>
                  <p class="card-text font-small-3 mb-0">Customize Members</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
              <div class="d-flex flex-row">
                   <div class="avatar bg-light-info p-50 m-0">
                    <div class="avatar-content">
                    <i  class="fas fa-users font-medium-5"></i>
                </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">{{dashboard.users.premium_members}}</h4>
                  <p class="card-text font-small-3 mb-0">Premium Members</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
                        <!-- Subscribers Chart Card starts -->
                             <div class="col-lg-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-warning p-50 m-0">
                                        <div class="avatar-content">
                                         <i  class="fas fa-book font-medium-5"></i>

                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1">{{dashboard.blogs}}</h2>
                                    <p class="card-text">Blogs</p>
                                </div>
                                <!-- <div id="order-chart"></div> -->
                             </div>
                         </div>

                        <!-- Orders Chart Card starts -->
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-warning p-50 m-0">
                                        <div class="avatar-content">
                                            <i  class="far fa-newspaper font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1">{{dashboard.articles}}</h2>
                                    <p class="card-text">Article</p>
                                </div>

                            </div>
                        </div>

                            <div class="col-lg-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-warning p-50 m-0">
                                        <div class="avatar-content">
                                            <i class=" far fa-calendar-plus font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1">{{dashboard.articles}}</h2>
                                    <p class="card-text">Events</p>
                                </div>

                            </div>
                        </div>
                        <!-- Orders Chart Card ends -->
                    </div>


                    <!-- List DataTable -->

                    <!--/ List DataTable -->
                </section>

  </div>
</template>

<script>
export default {
    data(){
        return {
            name:null,
            authuser:{},
            dashboard:{},
        };
    },
    methods:{
        loadDashboardData(){
            axios.get("/dashboard").then((res)=>{
                this.dashboard=res.data;
            });
        },
    },
    created(){
this.loadDashboardData();
    },
    mounted(){
        console.log("hello");
        this.loadDashboardData();
        this.authuser=user;
    },

}
</script>

<style>
.my-auto {
    margin-top: auto!important;
    margin-bottom: auto!important;
    margin-left: 10px;
}
</style>
