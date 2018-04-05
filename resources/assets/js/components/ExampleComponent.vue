<template>

   <div>           

            <center><a href="#" class="btn-lg btn-primary" @click="addNewQuestion">Adicionar Pergunta</a></center>
            <br>
            <br>

                <div v-for="(question,index) in questions" class="panel panel-primary copyright-wrap" id="copyright-wrap">
                    <div class="panel-heading">Pergunta {{index+1}}
                        <button type="button" class="close" data-target="#copyright-wrap" data-dismiss="alert"> <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

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
        <button type="submit" class="btn btn-info pull-right">Prosseguir</button>
      </div>
      <!-- /.box-footer -->

                  </div>     


</template>

<script>


import axios from 'axios';
    export default {
        data(){
        return {
            token:"",
           questions:[{
               question:"",
               answer:[{"op":''}]
           }]
               
           
    }
    },
        
        mounted() {
            console.log('Component mounted.')
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

                axios.post(`http://localhost:8000/admin/search/questions/create`,{
                    search:this.questions
                    //body.push
                })
                .then(response=>{
                    console.log(responses)
                })
                .catch(error =>{
                    console.log(error)
                })
            }
        }
    }
</script>
