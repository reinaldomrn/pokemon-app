(() => {
    var routeDefault = "https://pokeapi.co/api/v2/pokemon";
    var Main = {

        onReady(){
            $(document).on("click", "#btnSearch", async () => {
                Main.preloader();
                const inputText = $("#search").val().toLowerCase();
                if(inputText == ""){
                    Main.reset();
                }else{
                    const data = await axios.get(`/getPokemonByName?name=${inputText}`);
                    let aux = data.data;
                    if(aux.length == 0){
                        $("#msg").html(`No se encontro un pokemon con el nombre: ${inputText}`).removeClass("d-none");
                        $("#content-data").addClass("d-none");
                        $("#result").addClass("d-none");
                    }else{
                        $("#msg").addClass("d-none");
                        $("#content-data").html(Main.getBloq(aux)).removeClass("d-none");
                        $("#result").removeClass("d-none").html(`Resultado de la busqueda para: ${inputText} <hr />`);
                    }
                    Main.showHidePaginate(aux);
                    Main.preloader(false);
                }
            });

            $(document).on("click", "#next", async () => {
                Main.preloader();
                const data = await axios.get(
                    `/getPagePokemons?route=${$("#next").attr("data-route")}`
                );
                Main.setHtml(data.data);
            });

            $(document).on("click", "#previous", async () => {
                Main.preloader();
                const data = await axios.get(
                    `/getPagePokemons?route=${$("#previous").attr("data-route")}`
                );
                Main.setHtml(data.data);
            });
        },
        async reset(){
            const data = await axios.get(`/getPagePokemons?route=${routeDefault}`);
            Main.setHtml(data.data);
            $("#result").addClass("d-none");
            $("#msg").addClass("d-none");
            $("#content-data").removeClass("d-none");
        },
        setHtml(data){
            let html = "";
            data.pokemones.forEach(item => {
                html += Main.getBloq(item);
            });
            Main.showHidePaginate(data);
            $("#content-data").html(html);
            Main.preloader(false);
        },
        getBloq(data){
            return `<div class="col-md-4" style="margin-bottom: 10px;">
                <article class="card">
                    <div class="card-header" style="background: #5a5a5a;"></div>
                    <div class="card-body">
                        <img hei src="${data['image']}" alt="imagen de vitoko" class="card-body-img">
                        <h5 style="color: #014601; font-weight: bold;">${data["name"].charAt(0).toUpperCase()}${data["name"].slice(1)}</h5>
                    </div>
                    <div class="card-footer">
                        <div class="card-footer-social">
                            <h3>${data["experience"]}</h3>
                            <p>Experiencia</p>
                        </div>
                        <div class="card-footer-social">
                            <h3>${data["attack"]}</h3>
                            <p>Ataque</p>
                        </div>
                        <div class="card-footer-social">
                            <h3>${data["hp"]}</h3>
                            <p>HP</p>
                        </div>
                    </div>
                </article>
            </div>`;
        },
        showHidePaginate(data){
            $("#paginate").removeClass("d-none");
            ((data.next === null || !data.next)  && (data.previous === null ||  !data.next)) && $("#paginate").addClass("d-none");
            data.next === null
                ? $("#next").prop("disabled", true)
                : $("#next").prop("disabled", false).attr("data-route", data.next);
            data.previous === null
                ? $("#previous").prop("disabled", true)
                : $("#previous").prop("disabled", false).attr("data-route", data.previous);
        },
        preloader(show = true){
            show
                ? $("#preloader").css({ display: "block" })
                : $("#preloader").css({ display: "" });
        }

    }
    Main.onReady();
})()