---
extends: _layouts.conference
section: content
title: Modular Monoliths
presenter: Simon Brown
date_watched: 1689379200
rating: 5
venue: GOTO 2018
video_url: https://www.youtube.com/watch?v=5OjqD-ow8GE
categories:
  - Software Architecture
  - Modularity
description: "If you want evidence that the software development industry is susceptible to fashion, just go and take a look at all of the hype around microservices. It's everywhere! For some people microservices is 'the next big thing', whereas for others it's simply a lightweight evolution of the big service-oriented architectures that we saw 10 years ago 'done right'. Microservices is by no means a silver bullet though, and the design thinking required to create a good microservices architecture is the same as that needed to create a well structured monolith. And this begs the question that if you can’t build a well-structured monolith, what makes you think microservices is the answer?"
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