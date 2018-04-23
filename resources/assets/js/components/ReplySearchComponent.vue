<template>
  <div>
    Vue ok
  </div>
</template>

<script>

    import axios from 'axios';
  export default{
        data(){
            return {
                title:"TITULO",
                search:[],
                 questions:[{
               question:"",
               answer:[{"op":''}],
               text_answer:[{
                   'text_answer':''
               }]
           }]
            }
        },
        created()
        {
          let uri = location.pathname.split("/");

                let searchId  =  uri[3];
                //this.questions.push({"search_id":searchId}),
                axios.get(`http://localhost:8000/user/searches/`+searchId+`/get`)
                .then(response=>{
                  this.search = response.data;

                })
                .catch(error =>{
                    console.log(error)
                })
        }
    }
</script>
