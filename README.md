# Terminal-Style Portfolio Website

A personal portfolio website with a terminal/command-line aesthetic. This site showcases my projects, books I've read, conferences I've attended, and my GitHub contributions, all wrapped in a clean terminal-inspired interface.

## 🚀 Features

### 📝 General
- Terminal-inspired aesthetic with clean design
- Responsive layout that works on mobile and desktop
- Custom cursor and text animations for terminal feel
- Dark theme optimized for readability

### 📚 Books Collection
- Showcase books I've read with cover images
- Automatic book cover fetching from OpenLibrary API
- Book categorization (Completed, In Progress, To Read)
- Draft functionality to prepare entries before publishing
- Display reading progress for in-progress books
- Categories/tags for each book
- Notes and favorite quotes from each book

### 💻 Projects Portfolio
- Showcase development projects 
- Project categorization and filtering
- Technologies used for each project
- Project descriptions and links

### 🎤 Conferences
- Track conferences and talks attended
- Notes and takeaways from each conference
- Thumbnail images for visual reference

### 📊 GitHub Integration
- Displays contribution graph using GitHub API
- Shows PRs created in specific organizations
- Filters contributions by date range
- Organization-specific statistics
- Repository categorization by activity

### 📄 Experience
- Professional experience timeline
- Skills categorization and showcase
- Downloadable resume

### 📞 Contact Information
- Contact form
- Social media links
- Professional profiles

## 🛠️ Architecture

This portfolio is built using:

- **Jigsaw** - A framework for building static sites with PHP
- **Blade** Templates - Laravel's templating engine
- **Tailwind CSS** - For responsive styling
- **GitHub API** - For fetching contribution data
- **OpenLibrary API** - For fetching book covers

## 📁 Directory Structure

```
/
├── app/                # PHP application code
│   └── helpers/        # Helper functions for API interactions
├── build_local/        # Generated static site (local environment)
├── config.php          # Site configuration
├── source/             # Source files
│   ├── _assets/        # Asset files (compiled by webpack)
│   ├── _books/         # Book collection (Markdown)
│   ├── _conferences/   # Conference collection (Markdown)
│   ├── _layouts/       # Template layouts
│   ├── _partials/      # Reusable template parts
│   ├── _projects/      # Project collection (Markdown)
│   ├── assets/         # Static assets
│   └── *.blade.php     # Page templates
└── vendor/             # Dependencies
```

## ⚙️ Configuration

The site is configured via `config.php` and offers the following customization options:

- Title and meta information
- Author details and contact information
- GitHub token for API access
- Collection definitions and sorting

## 📚 Collections

### Books

Books are stored as Markdown files in `source/_books/` with the following frontmatter:

```yaml
---
extends: _layouts.book
section: content
title: "Book Title"
author: Author Name
status: completed # or in-progress, to-read, draft
date_finished: 1714348800 # Unix timestamp
isbn: 9781234567890
categories:
 - Category1
 - Category2
description: "Book description"
favorite_quote: "A favorite quote from the book"
---
```

Book statuses:
- `completed` - Books you've finished reading
- `in-progress` - Books you're currently reading
- `to-read` - Books you plan to read
- `draft` - Books that won't appear in the public listing

### Projects

Projects are stored as Markdown files in `source/_projects/` with details about each development project.

### Conferences

Conference notes and information are stored as Markdown files in `source/_conferences/`.

## 📷 Images and Media

- Book covers are automatically fetched from OpenLibrary based on ISBN
- Placeholder images are generated if no cover is available
- Project and conference images can be manually added

## 🔌 API Integrations

### GitHub API
- Uses GitHub's GraphQL API to fetch contribution data
- Requires a personal access token with appropriate permissions
- Configured via environment variables

### OpenLibrary API
- Used to fetch book covers based on ISBN
- Caches images locally for improved performance

## ⚡ Getting Started

### Prerequisites
- PHP 8.0+
- Composer
- Node.js and NPM

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/portfolio.git
   cd portfolio
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install JavaScript dependencies:
   ```bash
   npm install
   ```

4. Create a `.env` file with GitHub token:
   ```
   GITHUB_TOKEN=your_github_token
   ```

5. Build the site:
   ```bash
   vendor/bin/jigsaw build
   ```

6. Run the development server:
   ```bash
   npm run dev
   ```

## 🚀 Deployment

For production builds:

```bash
vendor/bin/jigsaw build production
```

The built site will be in the `build_production/` directory, ready to deploy to any static hosting service like Netlify, Vercel, or GitHub Pages.

## 💪 Adding New Content

### Adding a Book

1. Create a new Markdown file in `source/_books/`
2. Include required frontmatter
3. Add your notes and review
4. Rebuild the site

### Adding a Project

1. Create a new Markdown file in `source/_projects/`
2. Include project details
3. Rebuild the site

### Adding a Conference

1. Create a new Markdown file in `source/_conferences/`
2. Include conference details and notes
3. Rebuild the site

## 📄 License

This project is open-source and available under the MIT License. 