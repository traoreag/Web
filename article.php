<div id="contenuArticle" class ="contenuArticle">
    <p>Aucune article pour le moment</p>
    <script>
        // déclarer ici votre fonction javascript updateArticle
        function updateArticle() {
            const xhttpa = new XMLHttpRequest();
            xhttpa.onreadystatechange = function () {
                if (xhttpa.readyState == 4 && xhttpa.status == 200) {
                    document.getElementById("contenuArticle").innerHTML = xhttpa.responseText;
                }
            };
            xhttpa.open("POST", "http://192.168.56.80/pwnd/get_article.php", true);
            xhttpa.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttpa.send("id=1");
        }
        updateArticle();
        setInterval(updateArticle, 10000);
// Mettez à jour les articles initiales lors du chargement de la page
// en appelant votre fonction updateArticle
// Mettez en place une boucle pour mettre à jour les articles toutes les 10 secondes
// ci-dessous (étape 5) #3e3f5e
    </script>
</div>