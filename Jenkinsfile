def templateName = 'docker-in-docker'

  node(templateName) {
    checkout scm

    container(templateName) {
      try {
        stage('pre configure') {
          sh "apk update && apk add wget make git curl"
        }
        
        stage("docker login"){
          sh "echo $docker_password | docker login --username=$docker_username $docker_url --password-stdin"
        }

        // stage("build") {

        //   sh "make build"
        // }

        // stage('tag latest') {
        //     sh 'make tag-latest'
        // }

        stage('push docker images') {
          sh "make release"
        }

        stage ('Deploy to DevOps k8s cluster') {
          sh 'kubectl rollout restart deployment/tmgm-www-laravel-pub -n tmgm-www-php' //will force redeployment
        }
      }
      catch (err) {
        //echo "failed emailing ${EMAIL_ADDRESS}"
        throw err
        //sh 'sleep 1200'
      }
    }
  }
