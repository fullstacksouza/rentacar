<template>
  <div class="col-md-3">
            <div class="affix">
                <div class="well">
                    <h3>Escolha um tipo de pergunta</h3>
                </div>
                <!--/.well -->
                <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <a href=""><img class="card-img-top img-fluid" src="//placehold.it/100x100" alt="Card image cap"></a>
                        <div class="card-block">
                            <h4 class="card-title">Concordância</h4>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <a href=""><img class="card-img-top img-fluid" src="//placehold.it/100x100" alt="Card image cap"></a>
                        <div class="card-block">
                            <h4 class="card-title">Satisfatória</h4>
                            
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <!--/sidebar-nav-fixed -->
        </div>
</template>

<script>
    export default{
        data(){
            return {
                title:"TITULO"
            }
        },
        created()
        {
            console.log("emit called");
            eventBus.$emit("teste",this.title);
        }
    }
        
</script>
