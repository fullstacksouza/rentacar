<template>

   <div class="col-md-12">

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
                            <input v-validate="'required'"  v-model="question.question" type="text" class="form-control" id="inputEmail3" placeholder="Digite aqui a pergunta">

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

                            <input v-validate="'required'" v-model="ans.op" type="text" class="form-control" id="inputEmail3" :placeholder="'Digite a '+ (i+1)+'ª opção de resposta'">
                            </div>

                            <br>
                            <br>


                        </div>



                        </div>

                        <div :id="'endanswer'+index+'-'+i"></div>
                </div>


                <div v-for="(ans, i) in questions[index].text_answer" class="panel panel-warning copyright-wrap" :id="'copyright-wrap-ans-'+index+'-'+i">
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

                            <input  readonly v-model="ans.text_answer" type="text" class="form-control" id="inputEmail3" placeholder="Campo de texto aberto">
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
                        <center><button v-if="questions[index].text_answer.length < 1"  class="btn btn-warning" @click="addNewAnswerTextOption(index)" v-scroll-to="'#endanswer'+index+'-'+(answerLen(index)-1)">Adicionar Campo de Texto</button></center>
                    </div>
                </div>



               <!-- /.box-body -->
      <div class="box-footer">

        <a :href="'http://'+host+'admin/searches/list'" class="btn btn-default">Cancelar</a>
        <button type="submit" @click="sendQuestions" :disabled="this.validate()"  class ="btn btn-info pull-right">Prosseguir</button>
      </div>
      <!-- /.box-footer -->
            <center><button data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"  href="#" class="btn-lg btn-success" >Adicionar Pergunta</button></center>


                    <div id="end"></div>


<div class="collapse" id="collapseExample">
  <div class="well">
     <div class="row">
                <div class="col-sm-3">
                    <div class="card">
                        <a href="#"><img @click="addNewQuestion"   class="card-img-top img-fluid" :src="'http://'+host+'img/search/concordancia.jpeg'" alt="Card image cap"></a>
                        <div class="card-block">
                            <h4 class="card-title">Concordância</h4>

                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <a href="#"><img  @click="addSatisfyQuestion"  class="card-img-top img-fluid" :src="'http://'+host+'img/search/satisfy.jpeg'" alt="Card image cap"></a>
                        <div class="card-block">
                            <h4 class="card-title">Satisfatória</h4>

                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <a href="#"><img @click="addTextQuestion" class="card-img-top img-fluid" :src="'http://'+host+'img/search/text.jpeg'" alt="Card image cap"></a>
                        <div class="card-block">
                            <h4 class="card-title">Campo de texto</h4>

                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <a href="#"><img @click="addMultipleChoiceQuestion()" class="card-img-top img-fluid" :src="'http://'+host+'img/search/multiple-choose.jpeg'" alt="Card image cap"></a>
                        <div class="card-block">
                            <h4 class="card-title">Multipla Escolha</h4>

                        </div>
                    </div>
                </div>
                </div>
  </div>
</div>

                  </div>

</template>

<script>
import axios from "axios";

import VeeValidate from "vee-validate";
import scroller from "vue-scrollto/src/scrollTo";
export default {
  data() {
    return {
      index: 0,
      host: location.host+"/",
      uri: location.pathname,
      params: "",
      searchId: "",
      form: true,
      token: "",
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

  mounted() {
    this.questions.splice(0, 1);
    axios
      .get(
        "http://"+location.host+"/admin/searches/" +
          location.pathname.split("/")[3] +
          "/get"
      )
      .then(response => {
        var i;
        var j;
        var k;
        console.log(response.data.questions[0]);
        console.log("size " + response.data.questions.length);
        for (i = 0; i < response.data.questions.length; i++) {
          this.questions.push({
            question: response.data.questions[i].question,
            id: response.data.questions[i].id,
            answer: [],
            text_answer: [{}]
          });
          for (
            j = 0;
            j < response.data.questions[i].answer_options.length;
            j++
          ) {
            if (response.data.questions[i].answer_options[j].option.localeCompare("text"))
            {
              this.questions[i].text_answer.splice(0, 1);

              this.questions[i].answer.push({
                id: response.data.questions[i].answer_options[j].id,
                op: response.data.questions[i].answer_options[j].option
              });

            } else {
              this.questions[i].text_answer.splice(0, 1);

              console.log("POSSUI TEXTO");
              this.questions[i].text_answer.push({
                id: response.data.questions[i].answer_options[j].id,
                text_answer: ""
              });
            }
          }
          // alert(response.data.questions[i].answer_options[0].option)
          // this.questions.push({
          //   question: "",
          // });
          // for(j=0;j<response.data.questions[i].answer_options.length;j++)
          // {
          //   this.quesions[i].answer.push({
          //       op:"ll"
          //   });
          // }
        }
      })
      .catch(error => {
        console.log(error);
      });
    let uri = location.pathname.split("/");
    console.log(this.questions);
    this.questions.length;
  },
  watch: {
    questions: function(val) {
      //metodo de scroller
      this.scroll();
    }
  },

  methods: {
    validate() {
      this.$validator.validateAll().then(res => {
        if (res) {
          this.form = false;
        } else {
          this.form = true;
        }
      });
      return this.form;
    },
    addNewQuestion() {
      this.questions.push({
        question: "",
        answer: [
          { op: "Discordo Plenamente" },
          { op: "Discordo  Parcialmente" },
          { op: "Nem Concordo,Nem Discordo" },
          { op: "Concordo Parcialmente" },
          { op: "Concordo Plenamente" }
        ],
        text_answer: []
      });

      //this.scroll();
    },
    addSatisfyQuestion() {
      this.questions.push({
        question: "",
        answer: [
          { op: "Muito insatisfeito" },
          { op: "Insatisfeito" },
          { op: "Indiferente" },
          { op: "Satisfeito" },
          { op: "Muito satisfeito" }
        ],
        text_answer: []
      });
    },
    addTextQuestion() {
      this.questions.push({
        question: "",
        answer: [],
        text_answer: [{ text_answer: "" }]
      });
    },
    //pergunta de multipla escolha
    addMultipleChoiceQuestion() {
      this.questions.push({
        question: "",
        answer: [{op:""}],
        text_answer: []
      });

      this.$on("teste", function(data) {
        console.log(data);
      });
      //this.scroll();
    },

    addNewAnswerOption(index) {
      this.questions[index].answer.push({
        op: ""
      });
    },
    addNewAnswerTextOption(index) {
      console.log("log");
      this.questions[index].text_answer.push({
        text_answer: ""
      });
    },
    sendQuestions() {
      let uri = location.pathname.split("/");

      let searchId = uri[3];
      let url = "";
      if (location.hostname == "localhost") {
        url = "http://localhost/admin/search/" + searchId + "/update";
      } else {
        url =
          "http://" +
          window.location.hostname +
          "/admin/search/" +
          searchId +
          "/questions/create";
      }
      //this.questions.push({"search_id":searchId}),
      axios
        .post(url, {
          search: this.questions,
          search_id: searchId
        })
        .then(response => {
          if (location.hostname == "localhost") {
            url = "http://localhost/admin/search/" + searchId + "/preview";
            console.log(response);
            window.location = url;
          } else {
            //url ="http://rentacar.esy.es/admin/search/" + searchId + "/preview";
            url = "http://"+location.host+"/admin/search/" + searchId + "/preview";
console.log(response);
            window.location = url;
          }
        })
        .catch(error => {
          console.log(error);
        });
    },

    answerLen(index) {
      return this.questions[index].answer.length;
    },
    getQuestions() {
      alert("OOOOOK");
    },
    deleteQuestion(index) {
      if(this.questions[index].id)
      {
      let url = "";
       let searchId = location.pathname.split("/")[3];
       let questionId = this.questions[index].id;
        if (location.hostname == "localhost") {
          url = `http://localhost/admin/search/${searchId}/question/${questionId}/delete`;

        } else {
          url =
            "http://"+window.location.hostname+`/admin/search/${searchId}/question/${questionId}`;
        }

        axios.post(url)
        .then((response)=>{
          console.log(response);
        })
      }
      console.log("index da array " + index);
      this.questions.splice(index, 1);

    },
    deleteAnswer(iq, index) {
      if(this.questions[iq].answer[index].id)
      {
        let url = "";
       let searchId = location.pathname.split("/")[3];
       let questionId = this.questions[iq].id;
       let answerId = this.questions[iq].answer[index].id;
        if (location.hostname == "localhost") {
          url = `http://localhost/admin/search/${searchId}/question/${questionId}/answer/${answerId}/delete`;

        } else {
          url =
            "http://"+window.location.hostname+`/admin/search/${searchId}/question/${questionId}/answer/${answerId}/delete`;
        }

        axios.post(url)
        .then((response)=>{
          console.log(response);
        })
      }
      this.questions[iq].answer.splice(index, 1);
    },
    deleteTextAnswer(iq, index) {
      if(this.questions[iq].text_answer[index].id)
      {
        let url = "";
       let searchId = location.pathname.split("/")[3];
       let questionId = this.questions[iq].id;
       let answerId = this.questions[iq].text_answer[index].id;
        if (location.hostname == "localhost") {
          url = `http://localhost/admin/search/${searchId}/question/${questionId}/answer/${answerId}/delete`;

        } else {
          url =
            "http://"+window.location.hostname+`/admin/search/${searchId}/question/${questionId}/answer/${answerId}/delete`;
        }

        axios.post(url)
        .then((response)=>{
          console.log(response);
        })
      }
      this.questions[iq].text_answer.splice(index, 1);
    },

    scroll() {
      if (this.index == 0) {
        this.index = 1;
        var index = this.questions.length - 1;
        scroller("#end");
      } else {
        var prevIndex = this.questions.length;
        var lastAnswerIndex = prevIndex - 1;
        scroller("#end");
      }
    },

    created: function() {
      // `this` aponta para a instância
      console.log("a ");
    }
  }
};
</script>
