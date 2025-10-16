<?php

class FilmsView{

  public function showMovies($movies, $user){
    require_once 'templates/layouts/header.phtml';
    require_once 'templates/movies.phtml';        
    require_once 'templates/layouts/footer.phtml';
  }

  public function showMovie($movie, $user){
    require_once 'templates/layouts/header.phtml';
    require_once 'templates/movie.phtml';        
    require_once 'templates/layouts/footer.phtml';
  }

  public function showGenres($genresAndNumberOfMovies){
    require_once 'templates/layouts/header.phtml';
    require_once 'templates/genres.phtml';        
    require_once 'templates/layouts/footer.phtml';
  }
  
  public function showError($error){
    require_once 'templates/layouts/header.phtml';
    require_once 'templates/error.phtml';
    require_once 'templates/layouts/footer.phtml';
  }

  function showAddFilmForm($movie, $genres, $user) {
    require_once 'templates/layouts/header.phtml';
    require_once 'templates/filmForm.phtml';
    require_once 'templates/layouts/footer.phtml';
  }

  function updateFilmData($movie, $genres, $user) {
    require_once 'templates/layouts/header.phtml';
    require_once 'templates/formEditFilm.phtml';
    require_once 'templates/layouts/footer.phtml';
}

}