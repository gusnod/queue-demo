# Queue Demo


In order to run the php code php 8 and composer 2 is required

Install dependencies using composer and execute the ./console "binary" this will provide the
help information needed to test the application.

This demo also requires beanstalked, which can eiter be obtained from the following
[repo](https://github.com/beanstalkd/beanstalkd) or by running the below docker command

    docker run -it --rm -p 11300:11300 schickling/beanstalkd

### Tests
Tests can be executed using composer test
