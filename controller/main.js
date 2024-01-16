let search = document.getElementById("search");
let result = document.getElementById("result");

search.addEventListener("input", function () {
  let value = search.value;
  if (value == "") {
    console.log("walooo");
    result.innerHTML = "";
  } else {
    recherche(value)
      .then((wiki) => {
        if (wiki) {
          let wikiData = JSON.parse(wiki);
          console.log(wikiData);
          afficher(wikiData);
        }
      })
      .catch((error) => {
        console.log("errooor");
      });
  }
});

function recherche(value) {
  return new Promise((resolve, reject) => {
    let xhr = new XMLHttpRequest();
    xhr.onload = () => {
      if (xhr.readyState == 4) {
        if (xhr.status == 200) {
          resolve(xhr.response);
        } else {
          reject(xhr.statusText);
        }
      }
    };
    xhr.onerror = () => {
      reject(xhr.statusText);
    };
    xhr.open(
      "POST",
      "http://localhost/brief%20crois%C3%A9e/Wiki-/controller/ajaxse.php",
      true
    );
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(
      JSON.stringify({
        cherche: value,
      })
    );
  });
}

function afficher(data) {
  result.innerHTML = `
    ${data.map((element) => {
      return `
           
         <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <div class="bg-[url('../media/${element.image}')] bg-cover	bg-no-repeat	bg-center	w-full h-48">

                                </div>

                            </a>
                            <div class="p-5">
                                <a href="#" class="flex justify-between items-start">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">${element.titre}</h5>
                                    <p class='text-sm text-gray-700'>Creer le ${element.date}</p>
                                </a>
                                
                                <a href="wiki.php?wiki=${element.id}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Read more
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                    </svg>
                                </a>




                            </div>

        </div>
        `;
    })}

    `;
}
