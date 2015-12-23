<div class="carrusel-placeholder"></div>
<script id="carrusel-template" type="text/x-handlebars-template">
    <div class="row">
    <div class="box">
    <div class="col-lg-12 text-center">
    <div id="carousel-example-generic" class="carousel slide">
    <!-- Indicators -->
    <ol class="carousel-indicators hidden-xs">
    {{#each cantidad}}
    <li data-target="#carousel-example-generic" data-slide-to="{{elemento}}"></li>
    {{/each}}
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
    {{#each imagenes}}
    <div class="item{{#if rank}} active{{/if}}">
    <img class="img-responsive img-full" src="{{galeria_url}}" alt="{{rank}}.{{galeria_descripcion}}">
    </div>
    {{/each}}
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
    <span class="icon-prev"></span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
    <span class="icon-next"></span>
    </a>
    </div>
    <h2 class="brand-before">
    <small>Bienvenido a</small>
    </h2>
    <h1 class="brand-name">EasyArt</h1>
    <hr class="tagline-divider">
    <h2>
    <small>
    <strong>Llena de estilo tus espacios</strong>
    </small>
    </h2>
    </div>
    </div>
    </div>
</script>

<script>
    function crear_galeria() {
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