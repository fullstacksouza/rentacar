<template>
  <div>

    <div v-for="(question,index) in search.questions" class="panel panel-primary">
      <div class="panel-heading"><h2 class="text-center">{{question.question}}</h2></div>
      <div  class="panel-body">


            <div class="form-group" v-for="answer in search.questions[index].answer_options" >
                    <div class="radio">
                            <label>
                             <input v-if="answer.option != 'text'" type="radio" name="optionsRadios" id="optionsRadios1" :value="answer.id" checked>
                                    {{answer.option}}
                            </label>
                    </div>


             </div>




          </div>
    </div>
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
