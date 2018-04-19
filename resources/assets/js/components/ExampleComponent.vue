<template>

   <div class="col-md-8">

            <br>
            <br>

                <div v-for="(question,index) in questions" class="panel panel-primary copyright-wrap" :id="'copyright-wrap-'+index">
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

                            <!--- RESPOSTAS-->
                        <div v-for="(ans, i) in questions[index].answer" class="panel panel-info copyright-wrap" :id="'copyright-wrap-ans-'+index+'-'+i">
                    <div class="panel-heading">Resposta {{i+1}} - Selecionavel
                        <button type="button" @click="deleteAnswer(index,i)" class="close" data-target="#copyright-wrap-[i]" data-dismiss="alert">  <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                        </button>
                    </div>
                    <div class="panel-body">
                            <br>
                            <br>

                        <div class="form-group">
                            <label   for="inputEmail3" class="col-sm-2 control-label" white-space: nowrap>Opçao de resposta selecionavel</label>

                            <div class="col-sm-10">

                            <input  v-model="ans.op" type="text" class="form-control" id="inputEmail3" :placeholder="'Digite a '+ (i+1)+'ª opção de resposta'">
                            </div>

                            <br>
                            <br>


                        </div>



                        </div>

                        <div :id="'endanswer'+index+'-'+i"></div>
                </div>


                <div v-for="(ans, i) in questions[index].text_answer" class="panel panel-info copyright-wrap" :id="'copyright-wrap-ans-'+index+'-'+i">
                    <div class="panel-heading">Resposta do tipo  Campo de Texto
                        <button type="button" @click="deleteTextAnswer(index,i)" class="close" data-target="#copyright-wrap-[i]" data-dismiss="alert">  <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                        </button>
                    </div>
                    <div class="panel-body">
                            <br>
                            <br>

                        <div class="form-group">
                            <label   for="inputEmail3" class="col-sm-2 control-label" white-space: nowrap>Opçao de resposta aberta</label>

                            <div class="col-sm-10">

                            <input readonly v-model="ans.text_answer" type="text" class="form-control" id="inputEmail3" placeholder="Campo de texto aberto">
                            </div>

                            <br>
                            <br>


                        </div>



                        </div>

                        <div :id="'endanswer'+index+'-'+i"></div>
                </div>
                <!--endTEsy-->
                        <!--<div v-for="(ans, index) in questions[index].answer" class="form-group">
                            <label   for="inputEmail3" class="col-sm-2 control-label">Resposta {{index+1}}</label>

                            <div class="col-sm-10">
                            <input  v-model="ans.op" type="text" class="form-control" id="inputEmail3" :placeholder="'Digite a '+ (index+1)+'ª de resposta'">
                            </div>
                            <br>
                            <br>


                        </div>  -->
                        <center><button class="btn btn-primary" @click="addNewAnswerOption(index)" v-scroll-to="'#endanswer'+index+'-'+(answerLen(index)-1)">Adicionar Opçao de resposta</button></center>
                    <br>
                        <center><button class="btn btn-warning" @click="addNewAnswerTextOption(index)" v-scroll-to="'#endanswer'+index+'-'+(answerLen(index)-1)">Adicionar Campo de Texto</button></center>
                    </div>
                </div>



               <!-- /.box-body -->
      <div class="box-footer">

        <button type="submit" class="btn btn-default">Cancelar</button>
        <button type="submit" @click="sendQuestions" :disabled="questions.length< 1 "  class ="btn btn-info pull-right">Prosseguir</button>
      </div>
      <!-- /.box-footer -->
            <center><button href="#" class="btn-lg btn-success" @click="addNewQuestion"  >Adicionar Pergunta</button></center>


                    <div id="end"></div>


                  </div>

</template>

<script>


import axios from 'axios';
import scroller from 'vue-scrollto/src/scrollTo';
    export default {
        data(){

        return {
             index:0,
            uri: location.pathname,
            params:"",
            searchId:"",
            token:"",
            questions:[{
               question:"",
               answer:[{"op":''}],
               text_answer:[{
                   'text_answer':''
               }]
           }]


    }
    },

        watch:{
            questions: function(val){
                //metodo de scroller
                  this.scroll();
            }
        },

        methods:
        {
            addNewQuestion()
            {
                this.questions.push({
                    'question':'',
                    'answer': [],
                    'text_answer':[]
                });

                  this.$on('teste',function(data){
                       console.log(data);
                   })
                //this.scroll();
            },

            addNewAnswerOption(index)
            {
                this.questions[index].answer.push({
                    op:''
                });
            },
            addNewAnswerTextOption(index)
            {
                 this.questions[index].text_answer.push({
                    text_answer:''
                });
            },
            sendQuestions()
            {
                let uri = location.pathname.split("/");

                let searchId  =  uri[3];
                //this.questions.push({"search_id":searchId}),
                axios.post(`http://localhost:8000/admin/search/questions/create`,{
                    search:this.questions,
                    search_id: searchId
                 })
                .then(response=>{

                    window.location = "http://localhost:8000/admin/search/"+searchId+"/preview";
                    console.log(response);

                })
                .catch(error =>{
                    console.log(error)
                })
            },

            answerLen(index)
            {
                return this.questions[index].answer.length;
            },
            deleteQuestion(index)
            {
                console.log("index da array "+index);
                this.questions.splice(index,1);
                console.log(this.questions);
            },
            deleteAnswer(iq,index)
            {
                this.questions[iq].answer.splice(index,1);
            },
            deleteTextAnswer(iq,index)
            {
                this.questions[iq].text_answer.splice(index,1);
            },

            scroll()
            {
                if(this.index == 0)
                {
                    this.index = 1
                    var index  = ((this.questions.length)-1);
                    scroller("#end");
                }else{
                    var prevIndex = this.questions.length;
                    var lastAnswerIndex = (prevIndex-1);
                    scroller("#end");
                }

            },

             mounted() {
                 this.questions.length;
        },
        }
    }
</script>
