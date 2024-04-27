# Use an official Node.js runtime as a parent image
FROM node:14

# Set the working directory
WORKDIR /usr/src/app

# Install localtunnel globally within the container
RUN npm install -g localtunnel

# Make port 80 available to the world outside this container
EXPOSE 80

# Define environment variable
ENV NAME World

# Run localtunnel by default when the container launches
CMD ["lt", "--port", "80"]