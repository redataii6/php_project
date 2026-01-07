import './bootstrap';


const menu = document.getElementById('menu');
const menuliste = document.getElementById('menu-liste');
const body = document.body;
const femme = document.getElementById('femme');
const homme = document.getElementById('homme');
const liste_femme = document.getElementById('liste_femme');
const liste_homme = document.getElementById('liste_homme');
const fleche_femme = document.getElementById('fleche-femme');
const fleche_homme = document.getElementById('fleche-homme');
const utilisateur_icon = document.getElementById('utilisateur_icon');
const login_page = document.getElementById('login_page');


utilisateur_icon.addEventListener('click', function () {
    if (login_page.classList.contains('hidden')) {
        login_page.classList.remove('hidden');
        login_page.classList.add('block');
    } else {
        login_page.classList.remove('block');
        login_page.classList.add('hidden');
    }
}
);

menu.addEventListener('click', function () {
    if (menuliste.classList.contains('hidden')) {
        menuliste.classList.remove('hidden');
        menuliste.classList.add('block');
    } else {
        menuliste.classList.remove('block');
        menuliste.classList.add('hidden');
    }

});
body.addEventListener('click', function (event) {
    if (!menu.contains(event.target) && !menuliste.contains(event.target)) {
        menuliste.classList.remove('block');
        menuliste.classList.add('hidden');
    }
});
function toggleCategory(trigger, list, arrow) {
    trigger.addEventListener('click', function () {
        list.classList.toggle('hidden');
        list.classList.toggle('block');
        arrow.classList.toggle('rotate-90');
    });
}

toggleCategory(femme, liste_femme, fleche_femme);
toggleCategory(homme, liste_homme, fleche_homme);




function toggleFavori(productId) {
    fetch(`/favori/toggle/${productId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
        .then(res => res.json())
        .then(data => {
            const img = document.getElementById('favori-' + productId);
            img.src = data.favori ?
                "{{ asset('favori.png') }}" :
                "{{ asset('favoris.png') }}";
        });
}