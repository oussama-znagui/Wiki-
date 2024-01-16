<?php
include '../config/connexion.php';
// include '../model/user.php';
include '../model/wiki.php';
include '../model/tag.php';
session_start();
if (!$_SESSION['user'] || $_SESSION['user']->__get("role") != 1) {
    header('Location: index.php');
    die("eroor");
}
$Categories = Categorie::getCategories();

$wikis = Wiki::getWikis();
$tags = Tag::getTags();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Dashboard</title>
</head>

<body>
    <main>
        <section class="bg-gradient-to-tr from-rose-100 to-teal-100 h-auto p-10 min-h-screen">
            <nav class="flex justify-between items-center w-3/4 m-auto">
                <a href="index.php"><span class="flex text-1xl font-extrabold text-gray-900  md:text-2xl lg:text-3xl">Wikis
                        <div class="w-2 h-2 rounded-full bg-green-700">
                        </div>
                    </span></a>
                <div class="flex items-center gap-6">
                    <a class="text-gray-700 hover:text-orange-600" aria-label="Visit TrendyMinds LinkedIn" href="" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="h-5">
                            <path fill="currentColor" d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z">
                            </path>
                        </svg>
                    </a>
                    <a class="text-gray-700 hover:text-orange-600" aria-label="Visit TrendyMinds YouTube" href="" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="h-5">
                            <path fill="currentColor" d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z">
                            </path>
                        </svg>
                    </a>
                    <a class="text-gray-700 hover:text-orange-600" aria-label="Visit TrendyMinds Facebook" href="" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="h-5">
                            <path fill="currentColor" d="m279.14 288 14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z">
                            </path>
                        </svg>
                    </a>
                    <a class="text-gray-700 hover:text-orange-600" aria-label="Visit TrendyMinds Instagram" href="" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="h-5">
                            <path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z">
                            </path>
                        </svg>
                    </a>
                    <a class="text-gray-700 hover:text-orange-600" aria-label="Visit TrendyMinds Twitter" href="" target="_blank"><svg class="h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z">
                            </path>
                        </svg>
                    </a>
                </div>




                <div>


                    <a href="../controller/logout.php" class="text-gray-900 border-2 border border-gray-300  hover:bg-gray-100  font-medium rounded-lg text-sm px-5 py-2.5 ">logout</a>
                </div>


            </nav>

            <div class="w-3/4 bg-gray-100 m-auto my-10 rounded-2xl lg:flex text-center justify-around items-center p-5">
                <div>
                    <h1>nom complet</h1>
                    <h1 class="mb-4 text-3xl font-extrabold text-gray-900  md:text-5xl lg:text-xl text-center"><?php echo $_SESSION['user']->__get('fullName') ?></h1>
                </div>
                <div>
                    <h1>Email</h1>
                    <h1 class="mb-4 text-3xl font-extrabold text-gray-900  md:text-5xl lg:text-xl text-center"><?php echo $_SESSION['user']->__get('email') ?></h1>
                </div>
                <div>
                    <h1>Role</h1>
                    <h1 class="mb-4 text-3xl font-extrabold text-gray-900  md:text-5xl lg:text-xl text-center">Admin</h1>
                </div>
            </div>
            <div class="w-3/4 bg-gray-100 m-auto my-10 rounded-2xl lg:flex text-center justify-around items-center p-5">
                <div>
                    <h1>ALL Wikis</h1>
                    <h1 class="mb-4 text-3xl font-extrabold text-gray-900  md:text-5xl lg:text-4xl text-center"><?php echo Wiki::countWikis() ?></h1>
                </div>
                <div>
                    <h1>Categorie</h1>
                    <h1 class="mb-4 text-3xl font-extrabold text-gray-900  md:text-5xl lg:text-4xl text-center"><?php echo Categorie::countWiCat() ?></h1>
                </div>
                <div>
                    <h1>Tags</h1>
                    <h1 class="mb-4 text-3xl font-extrabold text-gray-900  md:text-5xl lg:text-4xl text-center"><?php echo Tag::countTags() ?></h1>
                </div>
                <div>
                    <h1>Auteur</h1>
                    <h1 class="mb-4 text-3xl font-extrabold text-gray-900  md:text-5xl lg:text-4xl text-center"><?php echo user::countUser() ?></h1>
                </div>
            </div>
            <div>


                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <h1 class="mb-4 text-3xl font-extrabold text-gray-900  md:text-5xl lg:text-4xl text-center">All Wikis</h1>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Titre
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    categorie
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Autuer
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($wikis as $wiki) {


                            ?>
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <?php echo $wiki->__get('titre') ?>
                                    </th>
                                    <td class="px-6 py-4">
                                        <?php echo $wiki->categorie->__get('titre') ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo $wiki->user->__get('fullName') ?>
                                    </td>
                                    <td class="px-6 py-4 flex items-center  gap-4">
                                        <?php
                                        if ($wiki->__get("statut") == 1) {

                                        ?>
                                            <p>Publié</p>
                                            <div class="w-2 h-2 bg-green-700 rounded-full"></div>

                                        <?php

                                        } else {
                                        ?>
                                            <p>Archivé</p>
                                            <div class="w-2 h-2 bg-red-700 rounded-full"></div>
                                        <?php
                                        }

                                        ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php
                                        if ($wiki->__get("statut") == 1) {

                                        ?>
                                            <a href="../controller/archiver.php?wiki=<?php echo $wiki->__get('id_wiki') ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Archiver</a>

                                        <?php

                                        } else {
                                        ?>
                                            <a href="../controller/desarchiverWiki.php?wiki=<?php echo $wiki->__get('id_wiki') ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Publier</a>
                                        <?php
                                        }

                                        ?>
                                    </td>
                                </tr>

                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>

            </div>


            <div id="categorie" class="my-10">
                <div class="flex justify-between items-center w-4/5 m-auto">
                    <h1 class="mb-4 text-3xl font-extrabold text-gray-900  md:text-5xl lg:text-4xl text-center">Categories</h1>
                    <a href="addcat.php" class="text-white bg-gray-800 hover:bg-gray-900 font-medium rounded-lg text-sm px-5 py-2.5">Creer une categorie</a>

                </div>
                <div class=" grid grid-cols-1 md:grid-cols-4 gap-4 w-4/5 m-auto my-5">


                    <?php
                    foreach ($Categories as $Categorie) {


                    ?>
                        <div class=" bg-gray-800 p-5 rounded-2xl">
                            <h1 class="text-white text-center font-black text-xl">
                                <?php echo $Categorie->__get('titre') ?>
                            </h1>
                            <div class="  m-auto flex my-5 justify-center gap-x-5 items-center ">
                                <a href="../controller/deletecat.php?cat=<?php echo $Categorie->__get('id_cat') ?>" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512">
                                        <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                    </svg>
                                </a>
                                <a href="editcat.php?cat=<?php echo $Categorie->__get('id_cat') ?>" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512">
                                        <path d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z" />
                                    </svg>

                                </a>

                            </div>



                        </div>




                    <?php

                    }
                    ?>





                </div>


            </div>


            <div id="tags" class="my-10">
                <div class="flex justify-between items-center w-4/5 m-auto">
                    <h1 class="mb-4 text-3xl font-extrabold text-gray-900  md:text-5xl lg:text-4xl text-center">Tags</h1>
                    <a href="addtag.php" class="text-white bg-gray-800 hover:bg-gray-900 font-medium rounded-lg text-sm px-5 py-2.5">nouveau tag</a>

                </div>
                <div class=" grid grid-cols-1 md:grid-cols-4 gap-4 w-4/5 m-auto my-5">


                    <?php
                    foreach ($tags as $tag) {


                    ?>
                        <div class=" bg-gray-600 p-5 rounded-2xl">
                            <h1 class="text-gray-900 text-center font-black text-xl">
                                <?php echo $tag->__get('tag') ?>
                            </h1>
                            <div class="  m-auto flex my-5 justify-center gap-x-5 items-center ">
                                <a href="../controller/delettag.php?tag=<?php echo $tag->__get('id_tag') ?>" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512">
                                        <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                    </svg>
                                </a>
                                <a href="edittag.php?tag=<?php echo $tag->__get('id_tag') ?>" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512">
                                        <path d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z" />
                                    </svg>

                                </a>

                            </div>



                        </div>




                    <?php

                    }
                    ?>





                </div>


            </div>



        </section>
    </main>

</body>

</html>