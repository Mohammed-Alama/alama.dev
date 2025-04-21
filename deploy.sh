#!/bin/bash

# Colors for terminal output
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[0;33m'
NC='\033[0m' # No Color

# Function to print colored messages
print_message() {
  echo -e "${GREEN}$1${NC}"
}

print_warning() {
  echo -e "${YELLOW}$1${NC}"
}

print_error() {
  echo -e "${RED}$1${NC}"
}

# Ask for commit message
read -p "Enter commit message (default: 'Update site content'): " commit_message
commit_message=${commit_message:-"Update site content"}

# Check if there are uncommitted changes
if [ -n "$(git status --porcelain)" ]; then
  print_message "Building production site..."
  vendor/bin/jigsaw build production
  
  print_message "Committing changes..."
  git add .
  git commit -m "$commit_message"
  
  print_message "Pushing to main branch..."
  git push origin main
else
  print_warning "No changes detected in the working directory."
  
  # Ask if user wants to continue
  read -p "Do you want to continue with deployment anyway? (y/n): " continue_deploy
  if [[ $continue_deploy != "y" && $continue_deploy != "Y" ]]; then
    print_warning "Deployment cancelled."
    exit 0
  fi
fi

print_message "Deploying to GitHub Pages..."
if git push origin $(git subtree split --prefix build_production main):gh-pages --force; then
  print_message "✅ Site deployed successfully to GitHub Pages!"
else
  print_error "❌ Deployment failed. Please check the error messages above."
  exit 1
fi

print_message "Your site should be live at https://alama.dev shortly!" 