# Deployment Makefile for alama.dev
# Usage: make deploy [MESSAGE="Your commit message"]

# Colors for terminal output
GREEN := \033[0;32m
RED := \033[0;31m
YELLOW := \033[0;33m
NC := \033[0m

# Default commit message
MESSAGE ?= Update site content

.PHONY: help build deploy confirm

help:
	@echo "Available targets:"
	@echo "  help   - Show this help message"
	@echo "  dev    - Build production site"
	@echo "  prod   - Build production site"
	@echo "  deploy - Deploy to Netlify (accepts MESSAGE='commit message')"

serve:
	@echo -e "$(GREEN)Serving development site...$(NC)"
	vendor/bin/jigsaw serve

dev:
	@echo -e "$(GREEN)Building development site...$(NC)"
	vendor/bin/jigsaw build

prod:
	@echo -e "$(GREEN)Building production site...$(NC)"
	vendor/bin/jigsaw build production

# Check for changes and deploy
deploy:
	@if [ -n "$$(git status --porcelain)" ]; then \
		echo -e "$(GREEN)Building production site...$(NC)"; \
		vendor/bin/jigsaw build production; \
		echo -e "$(GREEN)Committing changes...$(NC)"; \
		git add .; \
		git commit -m "$(MESSAGE)"; \
		echo -e "$(GREEN)Pushing to main branch...$(NC)"; \
		git push origin main; \
	else \
		echo -e "$(YELLOW)No changes detected in the working directory.$(NC)"; \
		echo -e "$(YELLOW)Do you want to continue with deployment anyway? [y/N]$(NC)"; \
		read -p "" continue_deploy; \
		if [ "$$continue_deploy" != "y" ] && [ "$$continue_deploy" != "Y" ]; then \
			echo -e "$(YELLOW)Deployment cancelled.$(NC)"; \
			exit 0; \
		fi; \
	fi
	@echo -e "$(GREEN)Deploying to Netlify...$(NC)"
	@if git push origin $$(git subtree split --prefix build_production main):gh-pages --force; then \
		echo -e "$(GREEN)✅ Site deployed successfully to Netlify!$(NC)"; \
		echo -e "$(GREEN)Your site should be live at https://alama.dev shortly!$(NC)"; \
	else \
		echo -e "$(RED)❌ Deployment failed. Please check the error messages above.$(NC)"; \
		exit 1; \
	fi

# Non-interactive version for CI environments
deploy-ci:
	@echo -e "$(GREEN)Building production site...$(NC)"
	vendor/bin/jigsaw build production
	@echo -e "$(GREEN)Committing changes...$(NC)"
	git add .
	git commit -m "$(MESSAGE)" || true
	@echo -e "$(GREEN)Pushing to main branch...$(NC)"
	git push origin main
	@echo -e "$(GREEN)Deploying to GitHub Pages...$(NC)"
	@if git push origin $$(git subtree split --prefix build_production main):gh-pages --force; then \
		echo -e "$(GREEN)✅ Site deployed successfully to GitHub Pages!$(NC)"; \
		echo -e "$(GREEN)Your site should be live at https://alama.dev shortly!$(NC)"; \
	else \
		echo -e "$(RED)❌ Deployment failed. Please check the error messages above.$(NC)"; \
		exit 1; \
	fi 