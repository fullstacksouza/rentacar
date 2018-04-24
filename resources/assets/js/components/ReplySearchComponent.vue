<template>
  <div>

    <div v-for="(question,index) in search.questions" class='panel panel-primary'>
      <div class="panel-heading"><h2 class="text-center">{{question.question}}</h2></div>
      <div  class="panel-body">
          <div class="form-group" v-for="answer in search.questions[index].answer_options" >

                    <div class="radio" v-if="answer.option !='text'">
                             <fieldset :id="'group'+index" v-validate="'required'">
                            <label >
                             <input v-model="answers[index].choice" type="radio" :name="'group'+index" id="optionsRadios1" :value="answer.id">
                                    {{answer.option}}
                            </label>
                              </fieldset>
                    </div>



                     <div class="form-group" v-else>
                        <label>
                        <input    type="radio" name="optionsRadios" id="optionsRadios1" value="textAnswer">
                        Nenhuma das opçoes acima?
                        </label>
                        <textarea type="text" class="form-control" id="inputEmail3"  name="text_answer" :disabled="textOptionSelect"></textarea>
                    </div>

            </div>

         </div>
    </div>

       <div class="box-footer">

    <a type="submit" class="btn btn-default">Cancelar</a>
        <button type="submit" @click="validate()"   class ="btn btn-info pull-right">Enviar Respostas</button>
      </div>
  </div>
</template>

<script>
import VeeValidate from "vee-validate";
import axios from "axios";
export default {
  data() {
    return {
      title: "TITULO",
      search: [],
      answers:[],
      textOptionSelect: true,
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
    validate() {
      this.$validator.validateAll().then(res => {
        if (res) {
            alert("nok")
        } else {
            alert("ok")
        }
      });
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
