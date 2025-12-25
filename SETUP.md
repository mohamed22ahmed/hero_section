# Prompt Improver - Setup & Run Guide

## Quick Start

### 1. Start Laravel Server
```bash
php artisan serve
```
The server will start at `http://127.0.0.1:8000`

### 2. Start Vite Dev Server (in a new terminal)
```bash
npm run dev
# or if npm is not installed, use:
npx vite
```

### 3. Access Application
Open your browser and navigate to:
```
http://127.0.0.1:8000
```

---

## Testing the Feature

1. **Enter a rough idea** in the textarea (e.g., "recipe sharing app")
2. **Click "Improve My Idea"** button
3. **Wait** for the loading animation
4. **Review** the comprehensive improved prompt
5. **Click "Copy"** to copy to clipboard
6. **Click "Try Another Idea"** to reset

---

## Example Prompts to Try

- `"online store for selling handmade crafts"`
- `"blog about travel experiences"`
- `"portfolio website for a photographer"`
- `"recipe app with ingredient search"`
- `"booking system for a salon"`
- `"analytics dashboard for sales data"`

---

## Troubleshooting

### If npm is not available:
Install Node.js first or use Docker:
```bash
# Ubuntu/Debian
sudo apt install npm

# Or install Node.js from https://nodejs.org
```

### If migrations fail:
Make sure database is configured in `.env`:
```bash
# Run migrations
php artisan migrate

# If needed, rollback and re-run
php artisan migrate:fresh
```

### If page is blank:
Check that both servers are running:
- Laravel: `http://127.0.0.1:8000`
- Vite: Look for "Local" URL in terminal (usually `http://127.0.0.1:5173`)
