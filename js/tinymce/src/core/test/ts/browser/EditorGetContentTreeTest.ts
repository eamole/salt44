import { Assertions } from '@ephox/agar';
import { GeneralSteps } from '@ephox/agar';
import { Logger } from '@ephox/agar';
import { Pipeline } from '@ephox/agar';
import { Step } from '@ephox/agar';
import { TinyApis } from '@ephox/mcagar';
import { TinyLoader } from '@ephox/mcagar';
import Serializer from 'tinymce/core/api/html/Serializer';
import Theme from 'tinymce/themes/modern/Theme';
import { UnitTest } from '@ephox/bedrock';

UnitTest.asynctest('browser.tinymce.core.EditorGetContentTreeTest', function () {
  const success = arguments[arguments.length - 2];
  const failure = arguments[arguments.length - 1];

  Theme();

  const toHtml = function (node) {
    const htmlSerializer = Serializer({});
    return htmlSerializer.serialize(node);
  };

  TinyLoader.setup(function (editor, onSuccess, onFailure) {
    const tinyApis = TinyApis(editor);

    Pipeline.async({}, [
      Logger.t('Get content as tree', GeneralSteps.sequence([
        tinyApis.sSetContent('<p>a</p>'),
        Step.sync(function () {
          const html = toHtml(editor.getContent({ format: 'tree' }));
          Assertions.assertHtml('Should be expected html', '<p>a</p>', html);
        })
      ])),
      Logger.t('Get selection as tree', GeneralSteps.sequence([
        tinyApis.sSetContent('<p>ab<em>c</em></p>'),
        tinyApis.sSetSelection([0, 0], 1, [0, 1, 0], 1),
        Step.sync(function () {
          const html = toHtml(editor.selection.getContent({ format: 'tree' }));
          Assertions.assertHtml('Should be expected selection html', 'b<em>c</em>', html);
        })
      ])),
      Logger.t('Get selection as tree with whitespace', GeneralSteps.sequence([
        tinyApis.sSetContent('<p>a b c</p>'),
        tinyApis.sSetSelection([0, 0], 1, [0, 0], 4),
        Step.sync(function () {
          const html = toHtml(editor.selection.getContent({ format: 'tree' }));
          Assertions.assertHtml('Should be expected selection html', ' b ', html);
        })
      ]))
    ], onSuccess, onFailure);
  }, {
    skin_url: '/project/js/tinymce/skins/lightgray',
    inline: true
  }, success, failure);
});
