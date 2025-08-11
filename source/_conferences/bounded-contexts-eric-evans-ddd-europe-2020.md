---
extends: _layouts.conference
section: content
title: "Bounded Contexts"
presenter: "Eric Evans"
date_watched: 1735689600
venue: "DDD Europe 2020"
video_url: https://www.youtube.com/watch?v=am-HXycfalo
categories:
  - Domain-Driven Design
  - Software Architecture
  - Bounded Contexts
  - Strategic Design
description: "Eric Evans, the creator of Domain-Driven Design, explores the concept of bounded contexts and how they help organize complex software systems by defining clear boundaries between different parts of the domain."
---

## Key Takeaways

### Understanding Bounded Contexts

Eric Evans explains the fundamental concept of bounded contexts in DDD:

- Bounded contexts define explicit boundaries within which a domain model applies
- They help manage complexity by dividing large domains into smaller, manageable pieces
- Each bounded context has its own ubiquitous language and model
- Contexts can overlap but should have clear integration points

### Strategic Design Principles

Key principles for designing bounded contexts:

- Identify natural boundaries based on business capabilities
- Ensure each context has a single, coherent responsibility
- Define clear relationships between contexts (shared kernel, customer-supplier, etc.)
- Avoid sharing models across contexts without explicit design decisions

### Context Mapping

Understanding relationships between bounded contexts:

- Different patterns for context integration (conformist, anticorruption layer, etc.)
- Importance of making context relationships explicit
- Managing dependencies between teams and contexts
- Evolution strategies for context boundaries

## How I'll Apply This

This foundational knowledge about bounded contexts will help me better structure large applications by identifying natural domain boundaries. I'll use these principles to create more maintainable codebases with clear separation of concerns and explicit integration points between different parts of the system.
