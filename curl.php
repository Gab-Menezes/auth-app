<?php
//192.168.15.12
$headers = [];
$accesstoken = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJ1c2VybmFtZSI6InByZWljaGVsIiwiaWF0IjoxNjMwOTc0MTc1LCJleHAiOjE2MzA5NzUwNzUsInN1YiI6Mn0.XmlktW9gIMp9hsFo7GurfFzB0mYRTHTgJCuAEh78h9aOj_3xxqDH3PKJb4p-yDox9cq5U2UPXqy-q7EeDd8OfhsjausuF9zPjhHPrJ4_SggaXidcI6K24QX7yIN3GAdCNzCmH4xEmfpiWj73xuSz71E1nFc1h9VyH_aDDrol3v7jIniwRlL0J-mttacLvTj846r1gNz0MmwDHl-mwILzXw9OpQgmNHqNj7--IHb1h0OBprP7SSW0AUx8uMvrV_3l9GmvT8mkNH1hJX9grH-vmq0DC0hQEJfDD8WhnhWIM8ywcIjZ_cP1b983roauJSERqsLJgeh45zWpl5RAWHieTFd00lz-DjDJr4WECnb7CyWKw_g0XJz0Lgoj6Z5Mbx2Vydbygo8b74lGgV97sl9ul39E7TdjHdf6ONR-weE4rZklf502ROyK3509Ho-wQWZLYKd5LWYn1-mdXRm4nmm0skzt8fl0hyqvutkTKatrokHB3slIkqK5srSsYSRuqqP35KNX7QQN_-s1dEzz1jRquwCUIDKcCHzDMdbfpjjZXEvqt34kPeqSV5S0gdVHC_6bIjRzb7AGCJjh28fFzKB9eR8zJnaUgcEx0A--MpiWw5Be9Pj_JKmpvftn7hXmtieiajPxjGt8_Ia-egQqz7j6jIKAgU5_SSe5vSrI4RUl0EM";
$headr[] = 'Authorization: Bearer '.$accesstoken;

$b1 = microtime(true);
$ch = curl_init();
$e1 = microtime(true);
echo $e1 - $b1 ."\n";

$b = microtime(true);
for ($i = 0; $i < 1000; $i++) {
    curl_setopt($ch, CURLOPT_URL, "http://host.docker.internal:80/api/me");
//    curl_setopt($ch, CURLOPT_URL, "http://192.168.15.12/api/me");
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headr);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
//    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    curl_exec($ch);
//    $result = curl_exec($ch);
}
$e = microtime(true);
curl_close($ch);



var_dump($e - $b);
