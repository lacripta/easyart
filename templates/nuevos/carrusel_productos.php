<div class="carrusel-placeholder"></div>
<script id="carrusel-template" type="text/x-handlebars-template">
<div class="row carousel-holder">
    <div class="col-md-12">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators hidden-xs">
                {{#each cantidad}}
                <li data-target="#carousel-example-generic" data-slide-to="{{elemento}}"></li>
                {{/each}}
            </ol>
            <div class="carousel-inner">
                {{#each imagenes}}
                <div class="item{{#if rank}} active{{/if}}">
                    <img class="img-responsive img-full" src="{{galeria_url}}" alt="{{rank}}.{{galeria_descripcion}}">
                </div>
                {{/each}}
            </div>
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
    </div>
</div>
</script>
<script>
    function galeria_productos() {
        var context = {
            imagenes: getJson('/easyapp/admin/producto/carrusel', {}),
            cantidad: [],
            primero: true
        };

        for (var x in context.imagenes) {
            context.cantidad.push({elemento: x});
        }
        //console.log(context);

        var theTemplate = Handlebars.compile($("#carrusel-template").html());
        var theCompiledHtml = theTemplate(context);
        $('.carrusel-placeholder').html(theCompiledHtml);
        $('.carousel').carousel({
            interval: 5000 //changes the speed
        });
    }
</script>