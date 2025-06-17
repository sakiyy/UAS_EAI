# Use official Node.js image
FROM node:14

# Set working directory
WORKDIR /usr/src/app

# Copy package.json and package-lock.json if exists
COPY package*.json ./

# Install dependencies
RUN npm install

# Copy all project files
COPY . .

# Expose port
EXPOSE 4000

# Start the application
CMD ["node", "src/index.js"]