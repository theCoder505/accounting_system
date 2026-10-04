with open(r'c:\xampp\htdocs\laravelwebsites\branex\branex_accounting\public\assets\frontend\css\main.css') as f:
    c = f.read()

import re
patterns = ['.service-widget', '.widget-service', '.service-singe2', '.service-single']
for p in patterns:
    idx = 0
    while True:
        pos = c.find(p, idx)
        if pos == -1:
            break
        print "=== FOUND:", p, "==="
        print c[max(0, pos-50):min(len(c), pos+300)]
        idx = pos + len(p)
