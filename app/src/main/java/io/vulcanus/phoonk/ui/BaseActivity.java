/*
 * Copyright 2015 Abhishek Dabholkar
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

package io.vulcanus.phoonk.ui;

import android.os.Bundle;
import android.support.annotation.StringRes;
import android.support.v7.app.ActionBar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;

import io.vulcanus.phoonk.R;

/**
 * Provides common functionality across all activities.
 * Provides a platform for all other activities to setup views that are common across all activities.
 * Base classes {@link BaseTopActivity}, {@link BaseNavDrawerActivity},
 * and {@link BaseTabbedActivity}
 */
public class BaseActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        setCustomTheme();
        super.onCreate(savedInstanceState);
    }

    /**
     * Sets theme across all activities.
     * Child classes can override this to use their own custom themes.
     */
    protected void setCustomTheme() {
        setTheme(R.style.ImmersiveTheme);
    }

    /**
     * Sets up the toolbar when requested by child activities.
     * Sub classes can extend this method to provide added functionality.
     */
    protected void setupToolbar() {
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
    }

    /**
     * Sets toolbar title when requested by child activities.
     * The method takes only a string resource as an argument.
     * This is because the titles for all activities are defined in an XML file and hence,
     * CharSequences are generally not used.
     * @param resId The child class must pass the string resource ID as an argument.
     */
    protected void setToolbarTitle(@StringRes int resId) {
        ActionBar actionBar = getSupportActionBar();
        assert actionBar != null;
        actionBar.setTitle(resId);
    }
}
