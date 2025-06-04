// import axios from 'axios';

// const API_KEY = '38682d354472785e7b94cd008c3ba2cb'; // remplaza con tu key de TMDB

// axios.get(`https://api.themoviedb.org/3/movie/popular`, {
//   params: {
//     api_key: API_KEY,
//     language: 'es-ES',
//     page: 1
//   }
// })
// .then(res => {
//   const list = document.getElementById('tmdb-list');
//   res.data.results.forEach(movie => {
//     const div = document.createElement('div');
//     div.innerHTML = `
//       <div class="mb-3">
//         <h5>${movie.title}</h5>
//         <img src="https://image.tmdb.org/t/p/w200${movie.poster_path}" alt="${movie.title}" />
//       </div>
//     `;
//     list.appendChild(div);
//   });
// })
// .catch(err => {
//   console.error('Error:', err);
// });