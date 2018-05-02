<template>
  <div>

    <div v-for="(question,index) in search.questions" class='panel panel-primary'>
      <div class="panel-heading"><h2 class="text-center">{{question.question}}</h2></div>
      <div  class="panel-body">
          <div class="form-group" v-for="answer in search.questions[index].answer_options" >

                    <div class="radio" v-if="answer.option !='text'">
                             <fieldset :id="'group'+index">
                            <label >
                             <input  v-validate="'required'" v-model="answers[index].choice" type="radio" :name="'group'+index" id="optionsRadios1" :disabled="answers[index].answer_text!= ''" :value="answer.id">
                                    {{answer.option}}
                            </label>
                              </fieldset>
                    </div>



                     <div class="form-group" v-else>
                         <fieldset :id="'group'+index">
                        <label>
                        Nenhuma das opçoes acima?
                        </label>
                        </fieldset>
                        <textarea  v-on:change="unselectRadio(index)" type="text" v-model="answers[index].answer_text" class="form-control" id="inputEmail3"  name="text_answer" ></textarea>
                    </div>

            </div>

         </div>
    </div>

       <div class="box-footer">

    <a type="submit" class="btn btn-default">Cancelar</a>
        <button type="submit" :disabled="this.validate()"  data-toggle="modal" data-target="#exampleModal"   class ="btn btn-info pull-right">Enviar Respostas</button>
      </div>

      <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmação de envio de respostas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja enviar as respostas para essa pesquisa?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" @click="sendAnswer()"  class="btn btn-primary">Enviar Respostas</button>
      </div>
    </div>
  </div>
</div>
  </div>
</template>

<script>
import VeeValidate from "vee-validate";

import axios from "axios";
export default {
  data() {
    return {
      form:true,
      text_answer:"",
      title: "TITULO",
      search: [],
      answers:[],
      textOptionSelect: false,
      questions: [
        {
          question: "",

          answer: [{ op: "" }],
          text_answer: [
            {
              text_answer: ""
            }
          ]
        }
      ]
    };
  },
  methods: {
    textAsnwer() {
      this.textOptionSelect = false;
    },
    validate()
            {
              this.$validator.validateAll().then(res=>{
                if(res) {
                    this.form = false;

                } else {
                    this.form = true;
                }
            });
            return this.form;
            },
    sendAnswer()
    {
      event.preventDefault();
		  event.target.disabled = true;
      let uri = location.pathname.split("/");

                let searchId  =  uri[3];
                //this.questions.push({"search_id":searchId}),
                axios.post(`http://localhost:8000/user/searches/`+searchId+`/reply`,{
                    answers:this.answers,
                    searchID: searchId

                 })
                .then(response=>{
                window.location = "http://localhost:8000/user/searches";

                    console.log(response);

                })
                .catch(error =>{
                    console.log(error)
                })
    },
    unselectRadio(index)
    {
      this.answers[index].choice = "";
    }
  },
  created() {



  },
  mounted(){
      let uri = location.pathname.split("/");

    let searchId = uri[3];
    //this.questions.push({"search_id":searchId}),
    axios
      .get(`http://localhost:8000/user/searches/` + searchId + `/get`)
      .then(response => {
        this.search = response.data;
        var i;
        for(i=0;i<this.search.questions.length;i++)
        {
            this.answers.push({
                'choice':'',
                'answer_text':'',
                'question':this.search.questions[i].id,
            })
        }
      })
      .catch(error => {
        console.log(error);
      });
  }
};
</script>
