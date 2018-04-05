<template>

   <div>           
    <button class="btn btn-primary" @click="addNewQuestion">Adicionar Pergunta</button>


<div   v-for="(question,index) in questions" class="panel panel-primary"  > 
    
      <div class="panel-heading">Pergunta do tipo : aberta {{index}}<span class="pull-right clickable" data-effect="fadeOut"><i class="fa fa-times"></i></span></div>
     
      <div class="panel-body">
          <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Pergunta</label>

          <div class="col-sm-10">
            <input  v-model="question.question" type="text" class="form-control" id="inputEmail3" placeholder="Pergunta" name="title">
          </div>
            <br> 
            <br>
          <label for="inputEmail3" class="col-sm-2 control-label">Resposta</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputEmail3" placeholder="Resposta" name="title" readonly> 
          </div>
        </div>
      </div>
    </div>

                  </div>     


</template>

<script>

import axios from 'axios';
    export default {
        data(){
            return{
                
             questions:[
                    {
                    question:'',
                    answer: [{
                        optionanswer:''
                    }]
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
                    'answer': ''
                });
            }
        }
    }
</script>
