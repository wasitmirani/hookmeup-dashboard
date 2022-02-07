<template>
   <div>
    <Breadcrumb current_name="Events" ></Breadcrumb>
      <div class="row" id="table-bordered">
          <div class="col-12">
              <div class="row">

                         <div class="col-lg-3 col-sm-6 col-12">
                          <StatisticsCard label="Total Events" :total="events.length" :value="events.length" icon="fas fa-file-alt" color="primary"></StatisticsCard>
                      </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                          <StatisticsCard label="Publish" :total="events.length" :value="events.length" icon="fas fa-file-alt" color="success"></StatisticsCard>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-12">
                          <StatisticsCard label="Pending" :total="events.length" :value="0" icon="fas fa-file-alt" color="warning"></StatisticsCard>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-12">
                          <StatisticsCard label="Trash" :total="events.length" :value="0" icon="fas fa-file-alt" color="danger"></StatisticsCard>
                      </div>
              </div>
          </div>
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <h2 class="card-title">
                  <span >All Events</span>
                        <div class="mt-2">

                             <vs-input color="#7d33ff" v-model="query"  v-on:keyup="searchQuery" placeholder="Search events" />
                        </div>

                    </h2>
                      <vs-button size="large"    gradient  to="/new/event" :active="true">
                            Add Event
                        </vs-button>
               </div>
               <div class="card-body">
                  <p class="card-text">

                  </p>
               </div>
               <div class="table-responsive">
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th >Title</th>
                            <th >Status</th>
                            <th >Short Description</th>
                            <th >Description</th>
                            <th >Created By</th>
                            <th >Created</th>
                            <th >Action</th>
                        </tr>
                     </thead>
                     <tbody>
                       <tr v-for="item in events" :key="item.id">
                              <th scope="row">{{ item.title }}</th>

                            <td><span class="badge rounded-pill badge-light-primary me-1 mt-2">Posted</span></td>
                               <td><span >{{ item.short_description }}</span></td>
                              <td>
                                 <p  v-html=" item.description"></p>
                              </td>
                              <td> <span class="badge rounded-pill badge-light-warning me-1">{{ item.user.name }}</span> </td>
                              <td> {{ item.created_at | timeformat }}</td>
                              <td>
                                <a role="button" @click="edit(item)">
                                    <i class="fas fa-edit text-primary"></i>
                                </a>
                                |
                                <a role="button"  @click="delete_Item(item)">
                                  <i class="fas fa-trash text-danger"></i>
                                </a>
                              </td>
                           </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
      <!-- Bordered table end -->
   </div>
</template>
<script>
import StatisticsCard from "../../components/StatisticsCard";
import Breadcrumb from "../../components/Breadcrumb";
   export default {
    components:{
        StatisticsCard,
        Breadcrumb
    },
    data(){
        return {
            events:{},
            query:"",
            isloading:false,
        }
    },
    //    https://preschool.dreamguystech.com/html-template
     methods:{
           openLoading() {
          const loading = this.$vs.loading()
          setTimeout(() => {
            loading.close()
          }, 1000)
        },
             searchQuery(){

                setTimeout(() => {

                    this.findevents();
                    }, 1500)
           },

           findevents(){
                this.openLoading();
                this.getevents();
           },

                delete_Item(item){
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
                                axios.get('/event/delete/'+item.id).then((res)=>{
                                            Swal.fire(
                                                'Deleted!',
                                                'Your file has been deleted.',
                                                'success')
                                                this.getevents();

                                });

                            }
                            })
                },
               getevents(){

                   axios.get("event/events?query="+this.query).then((res)=>{
                       this.events=res.data.events;
                   });
               },
               edit(item){
                this.$router.push('/update/event/'+item.id);
               }
       },
       mounted(){
           this.getevents();
       }

   }
</script>
<style lang="scss" >

.vs-input {
    border: 2px solid transparent;
    background: rgba(var(--vs-gray-2), 1);
    color: rgba(var(--vs-text), 1);
    padding: 7px 13px;
    border-radius: inherit;
    -webkit-transition: all 0.25s ease;
    transition: all 0.25s ease;
    padding-left: 10px;
    width: 100% !important;
}
</style>

