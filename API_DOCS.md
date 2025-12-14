# AniYume API Documentation

## Base URL
https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1
## Публичные эндпоинты (без токена)

### Получить список аниме
GET /anime
Query параметры:

type: tv, movie, ova, special, ona

status: ongoing, finished, upcoming

genre: action, comedy, drama (slug)

search: название для поиска

sort: rating, popularity, newest

page: номер страницы

Пример:
GET /anime?type=tv&status=ongoing&page=1

text

### Получить детали аниме
GET /anime/{id}

Пример:
GET /anime/1

text

### Получить эпизоды аниме
GET /anime/{id}/episodes

Пример:
GET /anime/1/episodes

text

### Получить конкретный эпизод
GET /anime/{anime_id}/episodes/{episode_id}

Пример:
GET /anime/1/episodes/78

text

### Получить жанры
GET /genres

text

### Получить студии
GET /studios

text

## Заголовки для Ngrok (обязательно!)

Добавь в каждый запрос:
headers: {
'ngrok-skip-browser-warning': 'true'
}

text

## Пример для React/Next.js

const API_BASE = 'https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1';

const fetchAnime = async () => {
const response = await fetch(${API_BASE}/anime, {
headers: {
'ngrok-skip-browser-warning': 'true'
}
});
return response.json();
};

text

## Пример для Axios

import axios from 'axios';

const api = axios.create({
baseURL: 'https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1',
headers: {
'ngrok-skip-browser-warning': 'true'
}
});

const getAnime = () => api.get('/anime');

text

## Структура ответов

### Anime List
{
"data": [
{
"id": 1,
"title": "Cowboy Bebop",
"poster_url": "https://...",
"rating": 8.6,
"year": 1998,
"type": "tv",
"status": "finished"
}
],
"links": {...},
"meta": {...}
}

text

### Anime Details
{
"data": {
"id": 1,
"title": "Cowboy Bebop",
"description": "...",
"poster_url": "https://...",
"rating": 8.6,
"genres": [...],
"studios": [...]
}
}

text

### Episodes
{
"data": [
{
"id": 78,
"episode_number": 1,
"title": "Asteroid Blues",
"player_url": "//kodik.info/...",
"translator": "AniLibria",
"quality": "720p"
}
]
}

text
undefined