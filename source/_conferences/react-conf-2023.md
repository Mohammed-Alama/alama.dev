---
extends: _layouts.conference
section: content
title: React Server Components Deep Dive
presenter: Dan Abramov
date_watched: 1689379200
rating: 5
venue: React Conf 2023
video_url: https://www.youtube.com/watch?v=5OjqD-ow8GE&list=LL&index=63&t=21s
categories:
  - React
  - JavaScript
  - Server Components
  - Frontend
description: "A comprehensive exploration of React Server Components, how they work, and how they fit into the React ecosystem."
favorite_quote: "Server Components are not about replacing client-side React, but about giving you the right tool for the right job."
---

## Key Takeaways

### Understanding Server Components

Dan provided an excellent mental model for understanding Server Components:

- Server Components run only on the server and never on the client
- They can access server-side resources directly (databases, file systems)
- The output is a special format that gets streamed to the client
- They don't include any JavaScript that would run on the client

### Server/Client Component Composition

The most interesting aspect was learning how server and client components can be composed together:

- Server components can render client components
- Client components cannot render server components directly
- Client components get serialized and sent to the client with their props

### Data Fetching Patterns

The new data fetching patterns are significantly simpler:

- Direct database access in Server Components
- No need for API endpoints for your own data
- Built-in request deduplication
- Automatic request waterfall prevention

## Practical Applications

I'm excited to refactor our dashboard to use Server Components for the data-heavy portions. This should significantly
improve our initial page load and reduce the amount of JavaScript we ship to the client.

The ability to access backend resources directly from components will make our architecture much cleaner, eliminating
many unnecessary API endpoints we currently maintain just for our frontend. 