<template>

   <div>           
 <button data-toggle="collapse" data-target="#demo">Collapsible</button>

<div id="demo" class="collapse">

<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="   " alt="Card image cap">
  <div class="card-body">
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div>

</div> 
            <center><button href="#" class="btn-lg btn-success" @click="addNewQuestion">Adicionar Pergunta</button></center>
            <br>
            <br>

                <div v-for="(question,index) in questions" class="panel panel-primary copyright-wrap" id="copyright-wrap">
                    <div class="panel-heading">Pergunta {{index+1}}
                        <button type="button" @click="deleteQuestion(index)" class="close" data-target="#copyright-wrap-[index]" data-dismiss="alert">  <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                        </button>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Pergunta</label>

                            <div class="col-sm-10">
                            <input v-model="question.question" type="text" class="form-control" id="inputEmail3" placeholder="Digite aqui a pergunta">
                            </div>
                        </div>     
                            <br>
                            <br>

                        <div v-for="(ans,index) in questions[index].answer" class="form-group">
                            <label   for="inputEmail3" class="col-sm-2 control-label">Resposta {{index+1}}</label>
                           
                            <div class="col-sm-10">
                            <input  v-model="ans.op" type="text" class="form-control" id="inputEmail3" placeholder="Digite aqui a pergunta">
                            </div>
                            <br>
                            <br>
                        

                        </div>  
                        <center><button class="btn btn-primary" @click="addNewAnswerOption(index)">Adicionar Opçao de resposta</button></center>   
                    </div>
                </div>
   
                
    
               <!-- /.box-body -->
      <div class="box-footer">

        <button type="submit" class="btn btn-default">Cancelar</button>
        <button type="submit" @click="sendQuestions" :disabled="questions.length< 1 "  class ="btn btn-info pull-right">Prosseguir</button>
      </div>
      <!-- /.box-footer -->

                  </div>     


</template>

<script>


import axios from 'axios';
    export default {
        data(){

        return {


            uri: location.pathname,
            params:"",
            searchId:"",
            token:"",
           questions:[{
               question:"",
               answer:[{"op":''}]
           }]
               
           
    }
    },
        
        mounted() {
            console.log(this.questions.length)
        },
        methods:
        {
            addNewQuestion()
            {
                this.questions.push({
                    'question':'',
                    'answer': []
                });
            },

            addNewAnswerOption(index)
            {
                this.questions[index].answer.push({
                    op:''
                })
            },

            sendQuestions()
            {
                let uri = location.pathname.split("/");

                let searchId  =  uri[3];
                this.questions.push({"search-id":searchId}),
                axios.post(`http://localhost:8000/admin/search/questions/create`,{
                    search:this.questions,
                 })
                .then(response=>{
                    console.log(responses)
                })
                .catch(error =>{
                    console.log(error)
                })
            },
            deleteQuestion(index)
            {
                console.log("index da array "+index);
                this.questions.splice(index,1);
                console.log(this.questions);
            }
        }
    }
</script>
